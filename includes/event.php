<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Event extends DatabaseObject {

    protected static $table_name = "event";
    protected static $db_fields = array('id', 'name', 'description', 'organiser', 'datetime', 'img');
    public $id;
    public $name;
    public $description;
    public $organiser;
    public $img;
    public $datetime;
    public $items;

    public static function make($name, $description, $organiser, $datetime) {
        $event = new self;
        $event->name = $name;
        $event->description = $description;
        $event->organiser = $organiser;
        $event->datetime = $datetime;

        return $event;
    }

    public function can_be_rated() {
        $dateFormat = 'Y-m-d';                                // Year-Month-Date.                          (2017-03-17)
        $timeFormat = 'h:i:s a';                              // Hours:Minutes:Seconds.                    (07:41:07 pm)
        $format = $dateFormat;          // Year-Month-Date Hours:Minutes:Seconds.    (2017-03-17 07:41:07 pm)

        $selected_zone = new DateTimeZone('Asia/Kolkata');

        $date2 = new DateTime('now', $selected_zone);
        $date = new DateTime($this->datetime, $selected_zone);

        $datediff = strtotime($date->format($format)) - strtotime($date2->format($format));

        $daysBetween = floor($datediff / (60 * 60 * 24));

        if ($daysBetween < 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_items() {
        if (!$this->items) {
            $sql = "select * from Item "
                    . "where id in"
                    . " ("
                    . " select item from eventitem"
                    . " where event={$this->id}"
                    . ") order by type";
            $this->items = Item::find_by_sql($sql);
        }
        return $this->items;
    }

    public function find_remaining_items() {
        $sql = "select * from Item "
                . "where id not in"
                . " ("
                . " select item from eventitem"
                . " where event={$this->id}"
                . ")";
        $items = Item::find_by_sql($sql);
        return $items;
    }

    public function find_remaining_items_of_type($type) {
        $sql = "select * from Item "
                . "where type='{$type}' and id not in"
                . " ("
                . " select item from eventitem"
                . " where event={$this->id}"
                . ")";
        $items = Item::find_by_sql($sql);
        return $items;
    }

    public function save() {
        $organiser = User::find_by_id($this->organiser);
        if ($organiser) {
            parent::save();
        } else {
            die('Organiser is not valid');
        }
    }

    public function create() {
        parent::create();
        $invitation = Invitation::make($this->id, $this->organiser, "You created the event!");
        $invitation->position = 'Admin';
        $invitation->status = 'Attending';
        $invitation->save();
    }

    public static function find_for_user($user_id) {
        if (!empty($user_id) && $user_id != 0) {
            $sql = "select * from ." . static::$table_name . " where organiser = $user_id and datetime >= CURRENT_DATE() order by datetime desc";
            return static::find_by_sql($sql);
        }
    }

    public function name() {
        return $this->name;
    }

    public function get_organiser() {
        return User::find_by_id($this->organiser);
    }

    public function anchor($image_size = "72px", $class = "", $classImg = "img img-thumbnail", $title = "org") {

        $anchor = "<a href=\"./view_event.php?event={$this->id}\" class=\"$class\" >"
                . $this->avatar($image_size, $classImg, $title)
                . "<em>"
                . $this->name()
                . "</em>"
                . "</a>";

        return $anchor;
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Event Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Name
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Description of Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event Organiser
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
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->name . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->get_organiser()->avatar() . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->datetime . "</td>"
                . "</tr>";
    }

}

?>