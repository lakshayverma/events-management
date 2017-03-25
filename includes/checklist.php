<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class CheckList extends DatabaseObject {

    protected static $table_name = "Checklist";
    protected static $db_fields = array('id', 'title', 'user', 'event', 'created_on', 'img');
    public $id;
    public $title;
    public $user;
    public $event;
    public $created_on;
    public $img;
    public $userObj, $eventObj;

    public static function make($title, $user, $event, $created_on, $img) {
        $checklist = new self;
        $checklist->title = $title;
        $checklist->user = $user;
        $checklist->event = $event;
        $checklist->created_on = $created_on;
        $checklist->img = $img;

        return $checklist;
    }

    public function name() {
        return $this->title;
    }

    public function init_members() {
        if (!$this->userObj) {

            $this->userObj = User::find_by_id($this->user);
        }

        if (!$this->eventObj) {
            $this->eventObj = Event::find_by_id($this->event);
        }
    }

    public function anchor($image_size = "72px", $class = "", $classImg = "img img-thumbnail", $title = "org") {

        $anchor = "<a onclick=\"showPopup(this.href);return(false);\" href=\"./view_checklist.php?list={$this->id}\""
                . "class=\"$class\""
                . ">"
                . $this->avatar($image_size, $classImg, $title)
                . "<em>"
                . $this->name()
                . "</em>"
                . "</a>";

        return $anchor;
    }

    public function get_author() {
        $this->init_members();
        return $this->userObj;
    }

    public function get_event() {
        $this->init_members();
        return $this->eventObj;
    }

    public static function find_all_for_event($event) {
        $sql = "select * from "
                . static::$table_name
                . " where event=$event";
        return self::find_by_sql($sql);
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Checklist Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Title
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        User
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Created On
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit) {
        return "
            <tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_author()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->created_on . "</td>"
                . "</tr>";
    }

}

?>