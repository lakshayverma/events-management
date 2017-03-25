<?php
$guest = Guest::is_guest($current_user->id, $current_event->id);
$guest = array_shift($guest);
$position = strtolower($guest->position);

if ($position == 'admin' || $position == 'member' || $current_event->organiser == $current_user->id):
    ?>

    <div class="tab-pane fade active" id="event_items">
        <ul class="list-group">
            <?php
            $table_records = $current_event->get_items();
            if ($table_records) :
                while ($eventItem = current($table_records)):
                    ?>
                    <li class="list-group-item">
                        <small>#<?php echo $eventItem->id;?></small><br>
                        <?php echo $eventItem->avatar("48px", "img img-thumbnail zoom-img"); ?>
                        <em><?php echo $eventItem->type; ?></em>
                        <strong><?php echo $eventItem->name(); ?></strong>
                        <blockquote>
                            <?php echo $eventItem->note($current_event->id); ?>
                        </blockquote>
                    </li>
                    <?php
                    next($table_records);
                endwhile;
            else:
                ?>
                <p>
                    No item has yet been selected.
                </p>
            <?php endif; ?>
        </ul>

        <?php
        if ($current_user->id == $current_event->organiser) :
            $object = new EventItem();
            ?>

            <div class="panel panel-default row">
                <h3 class="panel-heading text-capitalize">Add new Item</h3>
                <form id="form" class="panel-body form-inline" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                    <label class="col-form-label" for="item_type">Filter by Items Type</label>
                    <select class="form-control" onchange="fetch_items_of_type(<?php echo $current_event->id; ?>, this.value);return false;">
                        <?php
                        $options = Item::get_available_types();
                        include './layouts/data/options_list.php';
                        ?>
                        <option value="-" selected>All</option>
                    </select>

                    <label class="col-form-label" for="item">Item</label>
                    <select id="item" name="item" class="form-control" required>
                        <?php
                        $options = $current_event->find_remaining_items();
                        include './layouts/data/options_list.php';
                        ?>
                    </select>
                    <label class="col-form-label" for="note">Note</label>
                    <input type="text" id="note" name="note" class="form-control" value="<?php echo $object->note; ?>"/>

                    <input id="table_name" name="table_name" type="hidden" value="eventitem"/>
                    <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>

                    <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                    <input class="form-control btn btn-primary" type="submit" value="Add"/>
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
        <?php endif; ?>

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
