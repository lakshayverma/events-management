<div class="panel lakshay">
    <h4>Event Schedule</h4>
    <div id="schedule-accordion" class="panel-group">
        <?php
        $schedules = Schedule::find_all_for_event($current_event->id);
        while ($schedule = current($schedules)):
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#schedule-accordion" href="#schedule-<?php echo $schedule->id; ?>">
                        <span class="panel-title">
                            <?php echo $schedule->name(); ?> (<em><small><?php echo $schedule->datetime(); ?></small></em>)
                        </span>
                    </a>
                </div>
                <div id="schedule-<?php echo $schedule->id; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $schedule->description; ?>
                    </div>
                </div>
            </div>
            <?php
            next($schedules);
        endwhile;
        ?>
    </div>
    <?php if (!$current_event->can_be_rated()) : ?>
        <div class="panel panel-default">
            <h5 class="panel-heading">Make another schedule</h5>
            <?php $object = new Schedule(); ?>
            <form id="form" class="panel-body form-inline" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                <input name="title" class="form-control" type="text" placeholder="Title" required value="<?php echo $object->title; ?>"/>
                <input name="datetime" class="form-control" type="datetime-local" value="<?php echo $object->datetime; ?>"  required/>
                <input type="text" name="description" class="form-control" placeholder="Description" required/>
                <input id="table_name" name="table_name" type="hidden" value="schedule"/>
                <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                <input name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
            </form>
        </div>
    <?php endif; ?>
</div>