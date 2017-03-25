<?php
require_once('../includes/initialize.php');
global $session;
$table = $_POST["table_name"];
$users = $_POST['users'];
$invitations = array();
while ($guest = current($users)) {
    $object = Invitation::make($_POST['event'], $guest, $_POST['message']);
    $object->position = $_POST['position'];
    $object->status = $_POST['status'];
    if ($object->validate_attributes($object->insertion_attributes())) {
        $object->save();
    }
    next($users);
}
$redirect_url = (isset($_POST['redirect_url'])) ? $_POST['redirect_url'] : "../listTables.php?table={$table}";
redirect_to($redirect_url);
?>