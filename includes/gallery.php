<?php

// If it is going to need the database, then it is probably smart to require it before we start.
require_once(LIB_PATH . DS . "database.php");

class Gallery extends DatabaseObject {

    // this class is used for the database table named users.
    protected static $table_name = "gallery";
    protected static $db_fields = array('id', 'event', 'note', 'img');
    public $id;
    public $event;
    public $note;
    public $img;
    public $eventObj;

    public static function make($event, $note, $img) {
        $gallery = new Gallery();
        $gallery->event = $event;
        $gallery->note = $note;
        $gallery->img = $img;
    }

    public function validate_data() {
        $attributes = array('event', 'note', 'img');
        return $this->validate_attributes($attributes);
    }

    public function init_members() {
        if (!$this->eventObj) {
            $this->eventObj = Event::find_by_id($this->event);
        }
    }

    public static function find_all_for_event($event) {
        $sql = "select * from "
                . static::$table_name
                . " where event=$event";
        return self::find_by_sql($sql);
    }

    public function name() {
        return $this->note;
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Image ID
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Note
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        $this->init_members();
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->note . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->eventObj->avatar() . "</td>"
                . "</tr>";
    }

}

?>