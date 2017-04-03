<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Item extends DatabaseObject {

    protected static $table_name = "Item";
    protected static $db_fields = array('id', 'title', 'description', 'type', 'img');
    public $id;
    public $title;
    public $description;
    public $type;
    public $img;
    public $note;

    public static function make($title, $description, $type) {
        $item = new self;
        $item->title = $title;
        $item->description = $description;
        $item->type = $type;
        return $item;
    }

    public function name() {
        return $this->title;
    }

    public function title() {
        return $this->description;
    }

    public function note($event) {
        if (!$this->note) {
            $sql = "select * from eventitem where event=$event and item=$this->id";
            $eventItem = EventItem::find_by_sql($sql);
            $eventItem = array_shift($eventItem);
            $this->note = $eventItem->note;
        }
        return $this->note;
    }

    public static function get_available_types() {
        global $database;
        $sql = "select distinct type from item";
        $res = $database->query($sql);
        while (($row = mysqli_fetch_assoc($res))) {
            $objects[] = array_shift($row);
        }
        return $objects;
    }

    public static function find_ordered() {
        global $database;
        $sql = "select * from item order by type";
        $res = $database->query($sql);
        $objects = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $type = strtolower($row['type']);
            $objects[$type][] = $row;
        }
        return $objects;
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
                        Title
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Description
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Type
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->type . "</td>"
                . "</tr>";
    }

}

?>