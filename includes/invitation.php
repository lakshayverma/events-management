<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Invitation extends DatabaseObject {

    protected static $table_name = "Invitation";
    protected static $db_fields = array('id', 'event', 'user', 'message', 'date');
    public $id;
    public $event;
    public $user;
    public $message;
    public $date;
    public $position, $status;
    public $eventObj, $userObj, $guestObj;

    public static function make($event, $user, $message) {
        $invitation = new Invitation();
        $invitation->event = $event;
        $invitation->user = $user;
        $invitation->message = $message;
        $invitation->date = date("Y-m-d") . 'T' . date("h:i:s");
        return $invitation;
    }

    public static function find_all_for_user($user) {
        $sql = "select * from "
                . static::$table_name
                . " where user=$user order by date desc, id desc";
        return Invitation::find_by_sql($sql);
    }

    public static function find_upcoming($user) {
        $sql = "select * from "
                . static::$table_name
                . " where user=$user "
                . " and event in (select id from event where datetime >= CURRENT_DATE())"
                . " order by date desc, id desc";
        return Invitation::find_by_sql($sql);
    }
    public static function find_past($user) {
        $sql = "select * from "
                . static::$table_name
                . " where user=$user "
                . " and event in (select id from event where datetime < CURRENT_DATE())"
                . " order by date desc, id desc";
        return Invitation::find_by_sql($sql);
    }

    public function create() {
        parent::create();
        $this->init_members();
        $this->guestObj = Guest::make($this->user, $this->event, $this->position, $this->status);
        $this->guestObj->save();
    }

    public function update() {
        parent::update();
        $this->init_members();
        $this->guestObj->position = $this->position;
        $this->guestObj->status = $this->status;
        $this->guestObj->save();
    }

    public function init_members() {
        if ($this->event && $this->user) {
            $this->eventObj = Event::find_by_id($this->event);
            $this->userObj = User::find_by_id($this->user);
            $obj = Guest::find_by_sql(
                            "SELECT * FROM " . "guest"
                            . " where user=" . $this->user
                            . " and event=" . $this->event
                            . " order by id desc"
            );
            $this->guestObj = array_shift($obj);
            if (empty($this->status)) {
                $this->status = $this->guestObj->status;
            }
            if (empty($this->position)) {
                $this->position = $this->guestObj->position;
            }
        } else {
            $this->eventObj = new Event();
            $this->userObj = new User();
            $this->guestObj = new Guest();
        }
    }

    public function name() {
        $this->init_members();
        return "<div>"
                . ""
                . $this->eventObj->avatar()
                . $this->message
                . "</div>"
        ;
    }

    public function status() {
        switch ($this->status) {
            case 'Attending':
                $class = "success";
                $msg = "Looking forward to the event with you.";
                break;
            case 'Not Attending':
                $class = "danger";
                $msg = "Would have been nice of you to come.";
                break;

            case 'May Be':
                $class = "warning";
                $msg = "Awaiting response.";
                break;
        }
        return "<p class=\"text-$class\">$msg</p>";
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
                        User
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Message
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Position
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Status
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->eventObj->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->userObj->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->message . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->guestObj->position . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->guestObj->status . "</td>"
                . "</tr>";
    }

}

?>