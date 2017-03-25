<?php

include '../includes/initialize.php';
if (isset($_POST['event'])) {
    $type = (isset($_POST['type'])) ? $_POST['type'] : "-";
    $current_event = $_POST['event'];
    $current_event = Event::find_by_id($current_event);

    if ($type != "-") {
        $options = $current_event->find_remaining_items_of_type($type);
    } else {
        $options = $current_event->find_remaining_items();
    }
    
    include '../layouts/data/options_list.php';
}
?>