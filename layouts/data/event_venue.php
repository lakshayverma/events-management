<div class="tab-pane" id="event_venue">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <?php $event_venue = Venue::find_for_event($current_event->id); ?>

        <?php if (isset($event_venue->id)): ?>
            <h1 class="panel-heading">
                <?php echo $event_venue->avatar("72px", "img img-responsive img-thumbnail zoom-img", "-"); ?>
                <?php echo $event_venue->name(); ?>
            </h1>
            <div class="panel-body">
                <p class="text-justify text-primary">
                    <?php echo $event_venue->description; ?>
                </p>
                <p class="text-justify text-info">
                    <strong>Address: </strong>
                    <?php echo $event_venue->address; ?>
                </p>
            </div>
            <?php
        elseif ($current_user->id == $current_event->organiser) :
            if (!$current_event->can_be_rated()) :
                $object = new Venue();
                ?>
                <h4 class="panel-heading text-capitalize">book venue</h4>
                <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                    <div class="row form-group">
                        <?php
                        $venues = Venue::find_available($current_event->datetime("Y-m-d"));
                        while ($venue = current($venues)):
                            ?>
                            <div class="radio">
                                <label>                            
                                    <input type="radio" name="venue" value="<?php echo $venue->id; ?>"/>
                                    <div>
                                        <div class="col-md-2">
                                            <?php echo $venue->avatar("128px", "img img-thumbnail img-responsive zoom-img"); ?>
                                            <strong><?php echo $venue->name(); ?></strong>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2">
                                            <strong>Description</strong>
                                            <p>
                                                <?php echo $venue->description; ?>
                                            </p>
                                            <p>
                                                <strong>Capacity</strong>: <?php echo $venue->capacity; ?>
                                            </p>
                                            <strong>Address</strong>
                                            <p>
                                                <?php echo $venue->address; ?>
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <?php
                            next($venues);
                        endwhile;
                        ?>
                    </div>
                    <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                        <input name="bookedOn" class="form-control" type="hidden"  value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
                        <input id="table_name" name="table_name" type="hidden" value="eventVenue"/>
                        <input name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                        <input name="bookedBy" type="hidden" value="<?php echo $current_user->id; ?>"/>
                        <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                        <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
                        <input class="form-control btn " type="reset" value="Clear"/>
                    </div>
                </form>
                <?php
            endif;
        else:
            ?>
            <h4>No Venue has been decided yet.</h4>

        <?php endif; ?>
    </div>
</div>