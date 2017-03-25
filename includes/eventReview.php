<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class EventReview extends DatabaseObject {

    protected static $table_name = "eventreview";
    protected static $db_fields = array('id', 'event', 'user', 'title', 'description', 'posted_on', 'rating', 'img');
    public $id;
    public $event;
    public $user;
    public $title;
    public $description;
    public $posted_on;
    public $rating;
    public $eventObj, $userObj;
    public $img;

    public static function make($event, $user, $title, $description, $posted_on, $rating) {
        $event_review = new self;
        $event_review->event = $event;
        $event_review->user = $user;
        $event_review->title = $title;
        $event_review->description = $description;
        $event_review->posted_on = $posted_on;
        $event_review->rating = $rating;

        return $event_review;
    }

    public function name() {
        return $this->title;
    }
    
    public static function find_numerically($event){
        global  $database;
        $sql = "select rating, count(rating) from eventreview where event = {$event} GROUP by rating order by rating desc";
        $ratings = array();
        $total = 0;
        $result = $database->query($sql);
        while($row = $database->fetch_array($result)){
            $ratings[$row[0]] = $row[1];
            $total = $total + $row[1];
        }
        $ratings["total"] = $total;
        return $ratings;
    }

    public static function find_all_for_event($event) {
        $sql = "select * from "
                . static::$table_name
                . " where event=$event";
        return self::find_by_sql($sql);
    }

    public static function find_for_event_by_user($event_id, $user_id) {
        $sql = "select * from "
                . static::$table_name
                . " where event=$event_id"
                . " and user=$user_id";
        $review = self::find_by_sql($sql);
        return array_shift($review);
    }

    public function init_members() {
        $this->eventObj = Event::find_by_id($this->event);
        $this->userObj = User::find_by_id($this->user);
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
                        Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        User
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Title
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Description
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Posted On
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Rating
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->eventObj->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->userObj->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->posted_on . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->rating . "</td>
                </tr>";
    }

}

?>