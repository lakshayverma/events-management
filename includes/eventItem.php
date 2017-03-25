<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class EventItem extends DatabaseObject {

    protected static $table_name = "eventitem";
    protected static $db_fields = array('id', 'event', 'item', 'note');
    public $id;
    public $event;
    public $item;
    public $note;
    public $eventObj, $itemObj;

    public static function make($event, $item, $note) {
        $eventItem = new self;
        $eventItem->event = $event;
        $eventItem->item = $item;
        $eventItem->note = $note;
        return $eventItem;
    }

    public function name() {
        return "Nothing to show here";
    }

    public function init_members() {
        $this->eventObj = Event::find_by_id($this->event);
        $this->itemObj = Item::find_by_id($this->item);
    }

    public function get_event() {
        if (!$this->eventObj) {
            $this->init_members();
        }
        return $this->eventObj;
    }

    public function get_item() {
        if (!$this->itemObj) {
            $this->init_members();
        }
        return $this->itemObj;
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
                        Item
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Note
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_item()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->note . "</td>"
                . "</tr>";
    }

}

?>