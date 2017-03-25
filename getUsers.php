<?php
header('Content-Type: text/json; charset=utf-8');           // Specify Content-Type in Response Header so the client will know that it is in JSON.

require_once './includes/initialize.php';

$usr["users"] = User::find_all();

echo json_encode($usr);