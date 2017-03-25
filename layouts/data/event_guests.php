<div class="tab-pane active" id="event_guests">
    <ul class="list-group">
        <?php
        $table_records = Guest::find_all_for_event($current_event->id);
        if ($table_records) :
            while ($guestO = current($table_records)):
                $guest = $guestO->get_user();
                ?>
                <li class="list-group-item list-group-item-<?php echo $guestO->css_class(); ?>">
                    <?php echo $guest->avatar("72px", "img img-thumbnail zoom-img", "-"); ?>
                    <strong><?php echo $guest->name(); ?></strong>
                    <em>
                        (<?php echo $guestO->position; ?>)
                    </em>
                    <br>
                    <span class="row"><strong>Status</strong> : <?php echo $guestO->status; ?></span>
                </li>
                <?php
                next($table_records);
            endwhile;
            ?>
        <?php else: ?>
            <p>
                Nobody has been invited to this event yet.
            </p>
        <?php endif; ?>
    </ul>
    <?php
    if ($current_user->id == $current_event->organiser) :
        $object = new Invitation();
        ?>
        <div class="panel panel-default col-md-10 col-md-offset-1">
            <h4 class="panel-heading text-capitalize">Invite a new Guest</h4>
            <form id="form" class="panel-body" method="post" action="./logic/invite_guests.php" enctype="multipart/form-data">

                <div class="form-group col-md-6">
                    <label class="col-form-label" for="user">Guests</label>
                    <select name="users[]" class="form-control" required multiple>
                        <?php
                        $options = User::find_uninvited($current_event->id);
                        include './layouts/data/options_list.php';
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="position">Position</label>
                    <select name="position" class="form-control">
                        <?php
                        $options_guest = array('Guest of Honor', 'V.I.P', 'Guest', 'Member', 'Admin');
                        foreach ($options_guest as $option):
                            ?>
                            <option value="<?php echo $option; ?>">
                                <?php echo $option; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-form-label" for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" required><?php echo $object->message; ?></textarea>
                </div>
                <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                    <input id="table_name" name="table_name" type="hidden" value="invitation"/>
                    <input name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                    <input id="event" name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                    <input id="status" name="status" type="hidden" value="May Be"/>
                    <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
                    <input class="form-control btn " type="reset" value="Clear"/>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>