<?php
if ($position == 'admin' || $position == 'member' || $current_event->organiser == $current_user->id):
    ?>

    <div class="tab-pane fade" id="event_lists">
        <ul class="list-group">
            <?php
            $table_records = CheckList::find_all_for_event($current_event->id);
            if ($table_records) :
                while ($list = current($table_records)):
                    ?>
                    <li class="list-group-item">
                        <a onclick="showPopup(this.href);return(false);"
                           class="btn"
                           href="./view_checklist.php?list=<?php echo $list->id; ?>">
                               <?php echo $list->avatar("48px"); ?>
                            <strong><?php echo $list->name(); ?></strong>
                        </a>
                    </li>
                    <?php
                    next($table_records);
                endwhile;
            else:
                ?>
                <p>
                    No list has yet been created.
                </p>
            <?php endif; ?>
        </ul>

        <?php
        if (!$current_event->can_be_rated()) :

            if ($current_user->id == $current_event->organiser) :
                $object = new CheckList();
                ?>

                <div class="panel panel-default row">
                    <h3 class="panel-heading text-capitalize">New Checklist</h3>
                    <form id="form" class="panel-body form-inline" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                        <label class="col-form-label" for="title">Title</label>
                        <input id="title" name="title" class="form-control" type="text" required/>
                        <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                        <label class="col-form-label" for="img">Image</label>
                        <input id="img" name="img" class="form-control" type="file" accept="image/*" required/>
                        <input id="created_on" name="created_on" class="form-control" type="hidden" value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
                        <input id="table_name" name="table_name" type="hidden" value="checklist"/>
                        <input name="user" type="hidden" value="<?php echo $current_user->id; ?>"/>
                        <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                        <input class="form-control btn btn-primary" type="submit" value="Create New"/>
                    </form>
                </div>

                <script>
                    var formRules = {
                        rules: {

                        },
                        messages: {

                        }
                    };
                </script>    
                <?php
            endif;
        endif;
        ?>


    </div>

<?php else: ?>
    <div class="tab-pane fade" id="event_lists">
        <h1 class="panel-heading text-danger">
            Restricted!!
        </h1>
        <p class="panel-body">
            "You are a <strong class="text-capitalize"><?php echo $position; ?> </strong> and only Organizer or Members of event are allowed to see checklists."
        </p>
    </div>
<?php endif; ?>
