<?php

require_once './../includes/initialize.php';
$image = (isset($_POST['image'])) ? $_POST['image'] : false;
$comment = (isset($_POST['comment'])) ? $_POST['comment'] : false;
$user = $session->get_user_object();
$user_id = ($user->id) ? $user->id : false;


if ($image && $comment && $user_id) {
    $image_comment = ImageComment::make($image, $user_id, $comment);
    $image_comment->save();
    if ($image_comment->id) {
        $session->message("Comment Posted");
    } else {
        $session->message("Could not upload : " . $comment);
    }
} else {
    $session->message("Oops there was a problem with your request to post: " . $comment);
}
$redirect_url = (isset($_POST['redirect_url'])) ? $_POST['redirect_url'] : "../index.php";
redirect_to($redirect_url);