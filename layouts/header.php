<!Doctype html>
<?php
require_once('includes/initialize.php');
global $session;
$current_user = $session->get_user_object();
if ($current_user->id > 0) {
    $invitations = Invitation::find_all_for_user($current_user->id);
}
?>
<html lang="en">
    <head>
        <!--HTML specific data-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="dependencies/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="dependencies/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="custom/dist/css/select2.css">
        <link rel="stylesheet" href="custom/dist/css/custom.css">


        <!-- JavaScript libraries -->

        <script src="custom/dist/js/jquery-3.1.1.min.js"></script>
        <script src="dependencies/dist/js/bootstrap.min.js"></script>
        <script src="custom/dist/js/select2.js"></script>
        <script src="custom/dist/js/custom.js"></script>
        <script src="custom/dist/js/jquery.validate.min.js"></script>


        <!--Site Specific Data-->
        <title><?php echo (!empty($page_title)) ? $page_title : SITE_TITLE; ?></title>
        <meta name="theme-color" content="#101010">
        <link rel="icon" sizes="192x192" href="images/grapes.png">

    </head>
    <body>
        <?php if (isset($custom_header) && $custom_header): ?>
        <?php else: ?>
            <?php include 'site_header.php'; ?>
        <?php endif; ?>

        <?php if ($session->message()): ?>
            <div class="container-fluid">
                <h4 class="text-danger text-center"><?php echo $session->message(); ?></h4>
            </div>
        <?php endif; ?>