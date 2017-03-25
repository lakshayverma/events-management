<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Schedule extends DatabaseObject {

    protected static $table_name = "schedule";
    protected static $db_fields = array('id', 'event', 'title', 'description', 'datetime');
    public $id;
    public $event;
    public $title;
    public $description;
    public $datetime;

    public static function make($event, $title, $description, $datetime) {
        $schedule = new self;
        $schedule->event = $event;
        $schedule->title = $title;
        $schedule->description = $description;
        $schedule->datetime = $datetime;

        return $schedule;
    }
    public static function find_all_for_event($event) {
        $sql = "select * from "
                . static::$table_name
                . " where event=$event";
        return Schedule::find_by_sql($sql);
    }
    
    public function name(){
        return $this->title;
    }
    
    public function get_event() {
        return Event::find_by_id($this->event);
    }


    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Title
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Description
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Date Time
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td>" . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->datetime . "</td>"
                . "</tr>";
    }

}

?>