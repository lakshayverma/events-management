<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class Task extends DatabaseObject {

    protected static $table_name = "task";
    protected static $db_fields = array('id', 'checklist', 'title', 'details', 'status', 'deadline', 'img', 'assigned_to');
    public $id;
    public $checklist;
    public $title;
    public $details;
    public $status;
    public $deadline;
    public $img;
    public $assigned_to;
    public $checklistObj, $userObj;

    public static function make($checklist, $title, $details, $status, $deadline) {
        $task = new self;
        $task->checklist = $checklist;
        $task->title = $title;
        $task->details = $details;
        $task->status = $status;
        $task->deadline = $deadline;

        return $task;
    }

    public function name() {
        return $this->title;
    }
    
    public function deadline($format="h:i a, F d Y"){
        return static::format_datetime($format, $this->deadline);
    }

    public function init_members() {
        $this->checklistObj = CheckList::find_by_id($this->checklist);
        $this->checklistObj->init_members();
        $this->userObj = User::find_by_id($this->assigned_to);
    }

    public function get_user() {
        if (!$this->userObj) {
            $this->init_members();
        }
        return $this->userObj;
    }

    public function get_checklist() {
        if (!$this->checklistObj) {
            $this->init_memebers();
        }
        return $this->checklistObj;
    }

    public static function find_all_for_checklist($checklist) {
        $sql = "select * from "
                . static::$table_name
                . " where checklist=$checklist";
        return Task::find_by_sql($sql);
    }

    public function get_class() {
        $status = strtolower($this->status);

        switch ($status) {
            case 'assigned':
                return 'warning';
            case 'completed':
                return 'success';
            case 'failed':
                return 'danger';
            case 'started':
            case 'working':
            default :
                return 'default';
        }
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Task Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Check List
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Title
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Details
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Assigned To
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Status
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Deadline
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\">" . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_checklist()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->title . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->details . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->get_user()->intro() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->status . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->deadline . "</td>"
                . "</tr>";
    }

}

?>