<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Friend extends DatabaseObject {

    protected static $table_name = "friend";
    protected static $db_fields = array('id', 'person1', 'person2');
    public $id;
    public $person1;
    public $person2;
    public $friend1, $friend2;

    public static function make($person1, $person2) {
        $friend = new self;
        $friend->person1 = $person1;
        $friend->person2 = $person2;
        return $friend;
    }

    public function init_members() {
        $this->friend1 = User::find_by_id($this->person1);
        $this->friend2 = User::find_by_id($this->person2);
    }

    public static function are_friends($person1, $person2) {
        $p1 = Friend::find_by_sql("Select * from friend where person1 = {$person1} and person2 = {$person2}");
        $p1 = array_shift($p1);
        $p2 = Friend::find_by_sql("Select * from friend where person1 = {$person2} and person2 = {$person1}");
        $p2 = array_shift($p2);
        return ($p1 && $p2);
    }

    public static function find_friends($id) {
        $friends = User::find_by_sql(
                        "select * from user where id in (select u.id from friend requested_by
                        join friend responded_by
                          on requested_by.person1 = responded_by.person2
                         and requested_by.person2 = responded_by.person1
                         join user u
                         on u.id = responded_by.person1   
                      where requested_by.person1 ={$id})"
        );
        return $friends;
    }

    public function intro($image_size = "72px", $class = "", $classImg = "img img-thumbnail", $title = "org") {
        $this->init_members();

        return "<div>"
                . $this->friend1->intro($image_size, $class, $classImg, $title)
                . " - "
                . $this->friend2->intro($image_size, $class, $classImg, $title)
                . "</div>";
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Venue Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Person 1
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Person 2
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->friend1->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->friend2->intro() . "</td>"
                . "</tr>";
    }

}

?>