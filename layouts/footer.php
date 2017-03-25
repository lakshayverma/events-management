<?php if (isset($custom_footer) && $custom_footer): ?>
<?php else: ?>
    <hr>
    <footer class="container-fluid bottom">
        <a class="btn btn-info" href="mailto:<?php echo DEVELOPER_MAIL; ?>">
            <span class="glyphicon glyphicon-envelope"></span>
            <span>
                Contact
            </span>
        </a>
        <strong>
            <?php echo DEVELOPER_NAME; ?>
        </strong>
        <em><?php echo ", " . DEVELOPER_INFO ?></em>
    </footer>    
<?php endif; ?>

<script>
    $('select').select2();
</script>


<!-- Notifications -->
<div id="myNotifications" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pending Invitations</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php
                    $notifications_count = 0;
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
                            $notifications_count++;
                        endif;
                        next($invitations);
                    endwhile;
                    ?>

                </ul>
            </div>
        </div>
        <script>
            notifications(<?php echo $notifications_count; ?>);
        </script>
    </div>
</div>

</body>
</html>

<?php $database->close_connection(); ?>