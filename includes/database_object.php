<?php

//If it is going to need database, then it's probably smart to require it before we start
require_once(LIB_PATH . DS . 'database.php');

class DatabaseObject {

    public static function find_by_sql($sql = "") {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();                // NOTE solution to problem #1
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);      // NOTE using static:: instead of self:: for late static binding.
        }
        return $object_array;
    }

    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . static::$table_name);
    }

    public static function find_by_id($id) {
        global $database;
        $id = $database->escape_value($id);
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id = {$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
        $object = new static;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars); // all we need to confirm is the key exists irrespective of the value.
    }

    public function attributes() {
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // NOTE: does not alter the actual value of each attribute

        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    function insertion_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // NOTE: does not alter the actual value of each attribute

        foreach ($this->attributes() as $key => $value) {
            if ($key != "id") {
                $clean_attributes[$key] = $database->escape_value($value);
            }
        }
        return $clean_attributes;
    }

    public function validate_attributes($attributes = array()) {
        foreach ($attributes as $attribute) {
            if ($this->has_attribute($attribute) && empty($this->$attribute)) {
                return false;
            }
        }
        return true;
    }

    public function show_attributes($attributes = array()) {
        $string = "<ul>";
        foreach ($attributes as $attribute) {
            $string .= "<strong>{$attribute}</strong> {$this->$attribute}";
            if ($this->has_attribute($attribute) && empty($this->$attribute)) {
                $string .= "<strong>{$attribute}</strong> {$this->$attribute}";
            }
        }
        $string .= "</ul>";
        return $string;
    }

    public function get_db_fields() {
        return static::$db_fields;
    }

    // CRUD Functions
    public function save() {
        // A new record won't have an id yet.
        $this->upload_dir();
        return (isset($this->id) || ($this->id != null)) ? $this->update() : $this->create();
    }

    public function upload_dir() {
        $upload_dir = UPLOAD_PATH . DS . static::$table_name;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        return $upload_dir;
    }

    public static function image_dir() {
        return 'uploads' . DS . static::$table_name;
    }

    public function upload_img($img) {
        $tmp_file = $img['tmp_name'];
        $name = basename($img['name']);
        $destination = time() . "-" . rand(1000, 9999) . "-" . $name;
        move_uploaded_file($tmp_file, $this->upload_dir() . DS . $destination);
        return $destination;
    }

    public function create() {
        global $database;
        $attributes = $this->insertion_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES (\"";
        $sql .= join("\", \"", array_values($attributes));
        $sql .= "\")";

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function table_edit($editable = FALSE) {
        global $current_user;

        if (method_exists($this, "init_members")) {
            $this->init_members();
        }

        if ($current_user->type == 'admin' && $editable) {
            return "<td class=\"col-sm-12 col-md-2\">"
                    . "<a class=\"btn btn-warning\" href=\"?table=" . static::$table_name . "&id=$this->id\">"
                    . "<span class=\"glyphicon glyphicon-edit\"></span>" . $this->id
                    . "</a>"
                    . "</td>";
        } else {
            return "<td class=\"col-sm-12 col-md-2\">" . $this->id . "</td>";
        }
    }

    public function update() {
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $database;
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id=" . $database->escape_value($this->id) . " ";
        $sql .= "LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function datetime($format = "h:i a, F d Y") {
        if ($this->datetime) {
            return static::format_datetime($format, $this->datetime);
        }
    }
    
    public static function format_datetime($format = "h:i a, F d Y", $datetime){
            $dt = new DateTime($datetime);
            return $dt->format($format);
    }
    
    
    public function name(){
        return ".";
    }
    
    public function title(){
        return $this->name();
    }
    
    public function avatar($image_size = "72px", $class = "img img-thumbnail", $title = "org") {
        $title = ($title == "-") ? "" : $this->name();
        $class = $class . " img-square img-" . str_replace("px", "", $image_size);
        return "<img"
                . " width=\"$image_size\""
                . " height=\"$image_size\""
                . " alt=\" " . $this->name() . "\""
                . " title=\" " . $title . "\""
                . " class=\"$class\""
                . " src=\"" . $this->image_dir() . DS . $this->img . "\""
                . "/>";
    }

    public function intro($image_size = "72px", $class = "", $classImg = "img img-thumbnail", $title = "org") {
        global $session;
        $user = $session->get_user_object();
        if ($user->type == 'admin') {
            return "<a href=\"./list_tables.php?table=" . static::$table_name . "&id=$this->id\" class=\"$class\" >"
                    .
                    $this->avatar($image_size, $classImg, $title)
                    . "</a>";
        } else {
            return $this->avatar($image_size, $classImg, $title);
        }
    }

}

?>