<?php

$edit_records = FALSE;
$page_title = "Manage Events";
include './layouts/header.php';
members_only();
$events = Event::find_for_user($current_user->id);
$invited_events = Invitation::find_past($current_user->id);
$upcoming_events = Invitation::find_upcoming($current_user->id);
$current_event = (isset($_GET['event'])) ? $_GET['event'] : 0;
$current_event = Event::find_by_id($current_event);
if (!$current_event) {
    $current_event = current($events);
}
$event_organiser = $current_event->get_organiser();
include './layouts/data/event_renderer.php';
?>
<?php include './layouts/footer.php' ?>