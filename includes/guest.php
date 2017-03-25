<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Guest extends DatabaseObject {

    protected static $table_name = "guest";
    protected static $db_fields = array('id', 'user', 'event', 'position', 'status');
    public $id;
    public $user;
    public $event;
    public $position;
    public $status;

    public static function make($user, $event, $position, $status) {
        $guest = new self;
        $guest->user = $user;
        $guest->event = $event;
        $guest->position = $position;
        $guest->status = $status;
        return $guest;
    }

    public function get_user() {
        return User::find_by_id($this->user);
    }

    public function get_event() {
        return Event::find_by_id($this->event);
    }

    public static function find_all_for_event($event) {
        $sql = "select * from " . static::$table_name
                . " where event=$event";
        return static::find_by_sql($sql);
    }

    public static function is_guest($user_id, $event_id) {
        $sql = "select * from " . static::$table_name
                . " where user = '{$user_id}'"
                . " and event = '{$event_id}'";
        return self::find_by_sql($sql);
    }

    public function css_class() {
        switch ($this->status) {
            case 'Attending':
                return 'success';
            case 'Not Attending':
                return 'danger';
            case 'May Be':
                return 'warning';
        }
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Guest
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Event
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Position
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Invitation Status
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_user()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->get_event()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->position . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->status . "</td>"
                . "</tr>";
    }

}

?>