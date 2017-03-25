<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Venue extends DatabaseObject {

    protected static $table_name = "venue";
    protected static $db_fields = array('id', 'name', 'address', 'description', 'capacity', 'img');
    public $id;
    public $name;
    public $address;
    public $description;
    public $capacity;
    public $img;

    public static function make($name, $address, $description, $capacity) {
        $venue = new self;
        $venue->name = $name;
        $venue->address = $address;
        $venue->description = $description;
        $venue->capacity = $capacity;
        return $venue;
    }

    public function name() {
        return $this->name;
    }
    
    public static function find_available($date){
        $sql = "SELECT * from venue"
                . " where id not in "
                . "(select venue from eventvenue where"
                . " event in "
                . "(select id from event where event.datetime like '%$date%')"
                . ")";
        return Venue::find_by_sql($sql);
    }

    public static function find_for_event($event) {
        $sql = "select * from "
                . static::$table_name
                . " where id in (select venue from eventvenue where event=$event)";
        $venue = Venue::find_by_sql($sql);
        return array_shift($venue);
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Venue Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Name
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Description
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Capacity
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Address
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->name . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->capacity . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->address . "</td>"
                . "</tr>";
    }

}

?>