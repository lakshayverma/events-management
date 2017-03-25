<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class ImageComment extends DatabaseObject {

    protected static $table_name = "imagecomment";
    protected static $db_fields = array('id', 'image', 'user', 'comment', 'datetime');
    public $id;
    public $image;
    public $user;
    public $comment;
    public $datetime;
    public $imageObj, $userObj;

    public function init_members() {
        if (!$this->imageObj) {
            $this->imageObj = Item::find_by_id($this->image);
        }

        if (!$this->userObj) {
            $this->userObj = User::find_by_id($this->user);
        }
    }

    public static function find_for_image($image) {
        global $database;
        $sql = "select * from " . static::$table_name
                . " where"
                . " image = {$image->id}";
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $comment = static::instantiate($row);
            $comment->imageObj = $image;
            $comment->init_members();
            $object_array[] = $comment;
        }
        return $object_array;
    }

    public static function make($image, $user, $comment) {
        $image_comment = new self;
        $image_comment->image = $image;
        $image_comment->user = $user;
        $image_comment->comment = $comment;
        return $image_comment;
    }

    public function create() {
        global $database;
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= "image,user,comment";
        $sql .= ") VALUES (";
        $sql .= "{$this->image},{$this->user},'{$this->comment}'";
        $sql .= ")";
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function name() {
        return $this->comment;
    }

    public function title() {
        $this->init_members();
        return $this->userObj->intro();
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        User
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Comment
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Date Time
                    </th>
                </tr>
            </thead>';
    }

    public function get_user() {
        $this->init_members();
        return $this->userObj;
    }

    public function get_image() {
        $this->init_members();
        return $this->imageObj;
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->get_image()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->get_user()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->comment . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->datetime() . "</td>"
                . "</tr>";
    }

}

?>