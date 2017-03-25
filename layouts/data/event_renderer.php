<!-- Page Content -->
<div class="container-fluid">
    <!-- Heading Row -->
    <div class="col-md-2">
        <div>
            <h4 class="list-group-item-heading"><?php echo $page_title; ?></h4>
            <ul class="list-group">
                <?php
                while ($event = current($events)) {
                    if (($current_event->id == $event->id)) {
                        ?>
                        <li class="list-group-item active current">
                            <?php echo $event->name; ?>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="list-group-item">
                            <a href="?event=<?php echo $event->id; ?>">
                                <?php echo $event->name; ?>
                            </a>
                        </li>
                        <?php
                    }
                    next($events);
                }
                ?>
                <li class="list-group-item">
                    <a class="btn btn-success" data-toggle="collapse" data-target="#new_event">
                        <span class="glyphicon glyphicon-plus"></span> Create New event
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <h4 class="list-group-item-heading">Upcoming Events</h4>
            <ul class="list-group">
                <?php
                while ($invite = current($upcoming_events)) {
                    $invite->init_members();
                    $event = $invite->eventObj;
                    if (($current_event->id == $event->id)) {
                        ?>
                        <li class="list-group-item active current">
                            <?php echo $event->name; ?>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="list-group-item">
                            <a href="?event=<?php echo $event->id; ?>">
                                <?php echo $event->name; ?>
                            </a>
                        </li>
                        <?php
                    }
                    next($upcoming_events);
                }
                ?>
            </ul>
        </div>

        <div>
            <h6>Past Events</h6>
            <select id="past_events" onchange="openEvent(this.value)">
                <option>Events that are in Past.</option>
                <?php
                while ($invite = current($invited_events)) {
                    $invite->init_members();
                    $event = $invite->eventObj;
                    if (($current_event->id == $event->id)) {
                        ?>
                        <option selected value="<?php echo $event->id; ?>">
                            <?php echo $event->name; ?>
                        </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $event->id; ?>">
                            <?php echo $event->name; ?>
                        </option>
                        <?php
                    }
                    next($invited_events);
                }
                ?>
            </select>

            <script>
                $("#past_events").select2();
            </script>

        </div>
    </div>
    <!-- /.col-md-4 -->
    <div id="new_event" class="col-md-6 col-md-offset-1 <?php echo ($current_event) ? "collapse" : ""; ?>">
        <?php include './layouts/data/event_new.php'; ?>
    </div>
    <div id="contents" class="col-md-8">
        <?php include './layouts/data/event_details.php'; ?>
    </div>

    <div id="my_assigned_tasks" class="col-md-2">
        <h4>Assigned Tasks</h4>
        <?php
        $sql = "select * from task where assigned_to = $current_user->id"
                . " and"
                . " checklist in"
                . " (select id from checklist"
                . " where event in"
                . " (select id from event"
                . " where"
                . " datetime >= CURRENT_DATE()"
                . ")"
                . ")"
                . " order by deadline, status";
        $tasks = Task::find_by_sql($sql);
        ?>
        <?php
        while ($task = current($tasks)) :
            $task->init_members();
            ?>
            <div class="panel panel-<?php echo $task->get_class(); ?>">
                <div class="panel-heading">
                    <a class="unstyled" data-toggle="collapse" data-parent="#accordion" href="#task-<?php echo $task->id; ?>">
                        <span class="panel-title text-right text-<?php echo $task->get_class(); ?>)">
                            <?php echo $task->avatar("32px", "img img-thumbnail zoom-img", "-"); ?>
                            <?php echo $task->name(); ?>
                        </span>

                        <br>
                        <span>
                            Due by: <?php echo $task->deadline(); ?>
                        </span>
                    </a>
                </div>
                <div id="task-<?php echo $task->id; ?>" class="panel-collapse collapse out">
                    <div class="panel-body zoom-panel">

                        <blockquote class="task_details">
                            <?php echo $task->details; ?>
                        </blockquote>

                        <div class="details">
                            <?php
                            $taskParent = $task->checklistObj;
                            $taskEvent = $taskParent->eventObj;
                            ?>

                            <footer class="details">
                                <p>
                                    <small>
                                        Event: 
                                    </small>
                                    <?php echo $taskEvent->anchor("48px", "no-img", "img img-thumbnail"); ?>
                                    <br>
                                    <small>
                                        Checklist: 
                                    </small>
                                    <?php echo $taskParent->anchor("48px", "no-img", "img img-thumbnail"); ?>
                                    <?php // echo $taskParent->name(); ?>

                                </p>
                            </footer>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <?php if ($task->assigned_to == $current_user->id || $current_event->organiser == $current_user->id): ?>
                            <select name="task" class="form-control" onchange="modify_task(<?php echo $task->id; ?>, this.value);return false;">
                                <?php
                                $selected_option = $task->status;
                                $options = array('Assigned', 'Started', 'Working', 'Completed', 'Failed');
                                include './layouts/data/options_list.php';
                                ?>
                            </select>
                            <span id="span-task-<?php echo $task->id; ?>" class="text-success"></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            next($tasks);
        endwhile; // Tasks
        ?>
    </div>

    <!-- /.col-md-8 -->
</div>
<!-- /.row -->
