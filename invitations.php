<?php
$custom_header = TRUE;
$custom_footer = TRUE;
$edit_records = FALSE;
$page_title = "Invitations";
include './layouts/header.php';
members_only();
$invitations = Invitation::find_all_for_user($current_user->id);
?>
<header class="custom-header">
    <h4><span class="glyphicon glyphicon-bell"></span> <?php echo $page_title; ?></h4>
</header>
<div class="container">

    <ul class="list-group">
        <?php
        while ($invitation = current($invitations)) :
            $invitation->init_members();
            if ($invitation->status == 'May Be'):
                ?>
                <li class="list-group-item" id="invite-<?php echo $invitation->id; ?>">
                    <?php echo $invitation->eventObj->avatar("48px", "img img-thumbnail zoom-img"); ?>    
                    <strong><?php echo $invitation->eventObj->name(); ?></strong>
                    <p><?php echo $invitation->message; ?></p>
                    <div class="response">
                        <a class="btn btn-sm btn-success" onclick="attend_event(<?php echo $invitation->id; ?>, 1)">
                            Attending
                        </a>
                        <a class="btn btn-sm btn-default" onclick="attend_event(<?php echo $invitation->id; ?>, 0)">
                            Not Attending
                        </a>
                    </div>
                </li>
                <?php
            endif;
            next($invitations);
        endwhile;
        ?>
    </ul>
</div>
<?php include './layouts/footer.php' ?>