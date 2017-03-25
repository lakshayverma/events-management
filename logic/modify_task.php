<?php

header("Content-type: application/json"); // Adding a content type helps as well

require_once('../includes/initialize.php');
global $session;
$task_id = $_POST["task_id"];
$status = $_POST['status'];
$task = Task::find_by_id($task_id);
$task->status = $status;
$task->save();
echo json_encode($task);
