<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class ItemReview extends DatabaseObject {

    protected static $table_name = "itemreview";
    protected static $db_fields = array('id', 'event', 'item', 'user', 'title', 'description', 'posted_on', 'rating', 'img');
    public $id;
    public $event;
    public $item;
    public $user;
    public $title;
    public $description;
    public $posted_on;
    public $rating;
    public $img;
    public $itemObj, $userObj, $eventObj;

    public function init_members() {
        if (!$this->itemObj) {
            $this->itemObj = Item::find_by_id($this->item);
        }

        if (!$this->eventObj) {
            $this->eventObj = Event::find_by_id($this->event);
        }

        if (!$this->userObj) {
            $this->userObj = User::find_by_id($this->user);
        }
    }

    public static function make($event, $item, $user, $title, $description, $posted_on, $rating) {
        $item_review = new self;
        $item_review->event = $event;
        $item_review->item = $item;
        $item_review->user = $user;
        $item_review->title = $title;
        $item_review->description = $description;
        $item_review->posted_on = $posted_on;
        $item_review->rating = $rating;

        return $item_review;
    }

    public function name() {
        return $this->title;
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
                        Item
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

    public function get_user() {
        $this->init_members();
        return $this->userObj;
    }

    public function get_event() {
        $this->init_members();
        return $this->eventObj;
    }

    public function get_item() {
        $this->init_members();
        return $this->itemObj;
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class = \"col-sm-12 col-md-2\">" . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->get_item()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->get_user()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->description . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->posted_on . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->rating . "</td>"
                . "</tr>";
    }

}

?>