<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class EventVenue extends DatabaseObject {

    protected static $table_name = "eventvenue";
    protected static $db_fields = array('id', 'event', 'venue', 'bookedBy', 'bookedOn');
    public $id;
    public $event;
    public $venue;
    public $bookedBy;
    public $bookedOn;
    public $eventObj, $userObj, $venueObj;

    public static function make($event, $venue, $bookedBy) {
        $eventVenue = new self;
        $eventVenue->event = $event;
        $eventVenue->venue = $venue;
        $eventVenue->bookedBy = $bookedBy;
        return $eventVenue;
    }

    public function name() {
        return "Nothing to show here";
    }

    public function init_members() {
        $this->userObj = User::find_by_id($this->bookedBy);
        $this->eventObj = Event::find_by_id($this->event);
        $this->venueObj = Venue::find_by_id($this->venue);
    }

    public function get_user() {
        if (!$this->userObj) {
            $this->init_members();
        }
        return $this->userObj;
    }

    public function get_event() {
        if (!$this->eventObj) {
            $this->init_members();
        }
        return $this->eventObj;
    }

    public function get_venue() {
        if (!$this->venueObj) {
            $this->init_members();
        }
        return $this->venueObj;
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Booking Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Venue
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Booked By
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Booked On
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_venue()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_user()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->bookedOn . "</td>"
                . "</tr>";
    }

}

?>