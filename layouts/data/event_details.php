<?php
if ($current_event):
    $event_organiser = $current_event->get_organiser();
    $m_pos_db = Guest::is_guest($current_user->id, $current_event->id);
    $m_pos = array_shift($m_pos_db);
    $position = strtolower($m_pos->position);
    ?>
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <?php
                if (!$current_event->can_be_rated()) :
                    if ($current_user->id == $current_event->organiser) :
                        ?>
                        <li class="right">
                            <a href="#event_edit" data-toggle="tab"><span class="glyphicon glyphicon-edit"></span></a>
                        </li>
                        <?php
                    endif;
                endif;
                ?>
                <li class="active">
                    <a href="#event_description" data-toggle="tab">Event Details</a>
                </li>
                <li>
                    <a href="#event_guests" data-toggle="tab">Guests</a>
                </li>

                <?php if ($position == 'admin' || $position == 'member' || $current_event->organiser == $current_user->id): ?>
                    <li>
                        <a href="#event_items" data-toggle="tab">Items</a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="#event_lists" data-toggle="tab">Lists</a>
                </li>
                <li>
                    <a href="#event_images" data-toggle="tab">Images</a>
                </li>
                <li>
                    <a href="#event_venue" data-toggle="tab">Venue</a>
                </li>
                <?php if ($current_event->can_be_rated()): ?>
                    <li>
                        <a href="#event_reviews" data-toggle="tab">Review</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="event_description">
                    <header class="row">
                        <div class="col-md-10">
                            <div class="col-md-12">
                                <div class="col-md-4"><?php echo $current_event->avatar("128px", "img img-thumbnail zoom-img"); ?></div>
                                <div class="col-md-8">
                                    <p class="text-justify"><?php echo $current_event->description; ?></p>
                                    <span class="text-info"><?php echo $current_event->datetime(); ?></span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <?php if ($current_user->id == $current_event->organiser) : ?>
                        <div class="row">
                            <?php include './layouts/data/event_schedules.php'; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php include './layouts/data/event_guests.php'; ?>
                <?php include './layouts/data/event_items.php'; ?>
                <?php include './layouts/data/event_lists.php'; ?>
                <?php include './layouts/data/event_images.php'; ?>
                <?php include './layouts/data/event_venue.php'; ?>
                <?php
                if ($current_event->can_be_rated()) {
                    include './layouts/data/event_review.php';
                }
                ?>
                <?php include './layouts/data/event_edit.php'; ?>
            </div>
            <div class="panel-footer">
                <h6><strong>Organized By</strong></h6>
                <?php echo $event_organiser->avatar("48px"); ?>
                <?php echo $event_organiser->name(); ?>
            </div>
        </div>
    </div>
<?php else: ?>

<?php endif; ?>
