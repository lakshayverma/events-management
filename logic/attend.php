<?php

header("Content-type: application/json"); // Adding a content type helps as well

include '../includes/initialize.php';
$current_user = $session->get_user_object();
$invitation = Invitation::find_by_id($_POST['invitation_id']);
$invitation->init_members();
if ($_POST['status'] == '1') :
    $invitation->status = 'Attending';

else:
    $invitation->status = 'Not Attending';
endif;

$invitation->save();
$invitation->msg = $invitation->status();
echo json_encode($invitation);
?>