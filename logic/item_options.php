<?php

include '../includes/initialize.php';
if (isset($_POST['event'])) {
    $type = (isset($_POST['type'])) ? $_POST['type'] : "-";
    $current_id = $_POST['event'];
    if ($current_id > 0) {
        $current_event = Event::find_by_id($current_id);
    } else {
        $current_event = new Event();
        $current_event->id = 0;
    }

    if ($type != "-") {
        $options = $current_event->find_remaining_items_of_type($type);
    } else {
        $options = $current_event->find_remaining_items();
    }

    include '../layouts/data/options_list.php';
}
?>