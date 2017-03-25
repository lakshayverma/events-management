<div class="tab-pane fade active" id="event_reviews">    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4 class="text-info">Event Ratings</h4>
            <?php
            $ratings = EventReview::find_numerically($current_event->id);
            $ratings_available = FALSE;
            while ($rating = current($ratings)) :
                if (key($ratings) != "total") :
                    $number = ($rating / $ratings['total']) * 100;
                    $lal = number_format($number, 2, '.', '');

                    switch (key($ratings)) {
                        case 'Fantastic':
                        case 'Great':
                            $class = 'success';
                            break;
                        case 'Good':
                            $class = 'info';
                            break;
                        case 'Average':
                            $class = 'warning';
                            break;
                        case 'Below Average':
                        case 'Poor':
                            $class = 'danger';
                            break;
                        default :
                            $class = 'info';
                    }
                    $ratings_available = TRUE;
                    ?>
                    <strong><span class="glyphicon glyphicon-star text-<?php echo $class; ?>"></span>  <?php echo key($ratings); ?></strong>
                    <div class="progress">
                        <div class="progress-bar progress-bar-<?php echo $class; ?>" role="progressbar" aria-valuenow="<?php echo $lal; ?>"
                             style="width: <?php echo $lal; ?>%"
                             aria-valuemin="0" aria-valuemax="100">
                                 <?php echo $lal; ?>
                        </div>
                    </div>
                    <?php
                endif;
                next($ratings);
            endwhile;
            if (!$ratings_available):
                ?>
                <p class="text-warning">
                    Sorry but no one has rated this event yet!
                </p>
            <?php endif; ?>
        </div>
    </div>

    <h4 class="text-info">Event Reviews by Guests</h4>

    <ul class="list-group">
        <?php
        $table_records = EventReview::find_all_for_event($current_event->id);
        if ($table_records) :
            while ($review = current($table_records)):
                $review->init_members();
                ?>
                <li class="list-group-item list-group-item-warning">
                    <?php echo $review->avatar("128px", "img img-thumbnail zoom-img", "-"); ?>

                    <strong class="list-group-item-heading"><?php echo $review->name(); ?></strong>
                    <span class="text-right right"><small>Rating</small> : <?php echo $review->rating; ?></span>

                    <blockquote class="list-group-item-text">
                        <?php echo $review->description; ?>
                    </blockquote>

                    <footer class="right">
                        <em>Posted By:</em> <?php echo $review->userObj->intro("72px", "", "img img-thumbnail zoom-img", "-") . " " . $review->userObj->name(); ?>
                    </footer>
                </li>
                <?php
                next($table_records);
            endwhile;
        else:
            ?>
            <p>
                No one reviewed the event yet.
            </p>
        <?php endif; ?>
    </ul>

    <?php
    if (Guest::is_guest($current_user->id, $current_event->id) && $current_event->can_be_rated()) :
        $object = EventReview::find_for_event_by_user($current_event->id, $current_user->id);
        if (!$object) {
            $object = new EventReview();
        }
        ?>

        <div class="panel panel-default">
            <h3 class="panel-heading text-capitalize">Post a review</h3>
            <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="title">Title</label>
                    <input id="title" name="title" class="form-control" type="text" value="<?php echo $object->name(); ?>" required/>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="img">Image</label>
                    <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php echo ($object->img) ? "" : "required"; ?>/>
                </div>

                <div class="form-group col-md-4">
                    <label class="col-form-label" for="rating">Rating</label>
                    <select id="rating" name="rating" class="form-control">
                        <?php
                        $options = array('Fantastic', 'Great', 'Good', 'Average', 'Below Average', 'Poor');
                        $selected_option = $object->rating;
                        include './layouts/data/options_list.php';
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label class="col-form-label" for="title">Description</label>
                    <textarea name="description" class="form-control" type="text" required><?php echo $object->description; ?></textarea>
                </div>
                <div>
                    <input class="form-control btn btn-primary" type="submit" value="Post"/>

                    <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                    <input name="posted_on" class="form-control" type="hidden" value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
                    <input name="table_name" type="hidden" value="eventreview"/>
                    <?php if ($object->id): ?>
                        <input name="id" class="form-control" type="hidden" readonly value="<?php echo $object->id; ?>"/>
                    <?php endif; ?>
                    <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                    <input name="user" type="hidden" value="<?php echo $current_user->id; ?>"/>
                </div>
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