<!-- Page Content -->
<header class="custom-header">
    <h4><?php echo $current_list->name(); ?></h4>
</header>
<div class="container-fluid">
    <!-- Heading Row -->
    <div class="panel-group" id="accordion">
        <?php
        $tasks = Task::find_all_for_checklist($current_list->id);
        while ($task = current($tasks)) {
            $task->init_members();
            $user = $task->get_user();
            ?>
            <div class="panel panel-<?= $task->get_class(); ?>">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#task-<?php echo $task->id; ?>">
                        <h6 class="panel-title">
                            <?php echo $task->avatar("48px"); ?>
                            <?php echo $task->name(); ?>
                        </h6>
                    </a>
                </div>
                <div id="task-<?php echo $task->id; ?>" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <blockquote>
                            <?php echo $task->details; ?>
                        </blockquote>
                        <p>
                            Due by: <?php echo $task->deadline(); ?>
                        </p>
                    </div>
                    <div class="panel-footer">
                        <?php if ($task->assigned_to == $current_user->id || $current_event->organiser == $current_user->id): ?>

                            <?php if (!$current_event->can_be_rated()) : ?>

                                <select name="task" class="form-control" onchange="modify_task(<?php echo $task->id; ?>, this.value);return false;">
                                    <?php
                                    $selected_option = $task->status;
                                    $options = array('Assigned', 'Started', 'Working', 'Completed', 'Failed');
                                    include './layouts/data/options_list.php';
                                    ?>
                                </select>
                                <span id="span-task-<?php echo $task->id; ?>" class="text-success"></span>
                            <?php else: ?>
                                <?php echo $task->status; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo $task->status; ?>
                        <?php endif; ?>
                        <?php echo $user->avatar("32px") . " " . $user->name(); ?>
                    </div>
                </div>
            </div>
            <?php
            next($tasks);
        }
        ?>
    </div>
    <?php
    if (!$current_event->can_be_rated()) :
        if ($current_user->id == $current_event->organiser) :
            ?>
            <div class="panel panel-default col-md-12">
                <h3 class="panel-heading text-capitalize">Add a new Task</h3>
                <?php $object = new Task(); ?>

                <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-form-label" for="title">Title</label>
                        <input id="title" name="title" class="form-control" type="text" value="<?php echo $object->title; ?>" required />
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="assigned_to">Assign To</label>
                        <select id="assigned_to" name="assigned_to" class="form-control" required>
                            <?php
                            $options = User::find_members_of_event($current_event->id);
                            include 'options_list.php';
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="deadline">Deadline</label>
                        <input id="deadline" name="deadline" class="form-control" type="<?php echo ($object->deadline) ? 'text' : 'datetime-local'; ?>" value="<?php echo $object->deadline; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="img">Image</label>
                        <input id="img" name="img" class="form-control" type="file" accept="image/*"  <?php echo ($object->img) ? '' : 'required'; ?>/>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <?php
                            $selected_status = $object->status;
                            $options_rate = array('Assigned', 'Started', 'Working', 'Completed', 'Failed');
                            foreach ($options_rate as $option):
                                ?>
                                <option value="<?php echo $option; ?>"
                                        <?php echo ($option === $selected_status) ? 'selected' : ''; ?> >
                                            <?php echo $option; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="details">Details</label>
                        <textarea id="details" name="details" class="form-control" required><?php echo $object->details; ?></textarea>
                    </div>
                    <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                        <input id="table_name" name="table_name" type="hidden" value="task"/>
                        <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                        <input name="checklist" type="hidden" value="<?php echo $current_list->id; ?>"/>
                        <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="panel panel-danger">
                <h3 class="panel-heading text-capitalize text-danger">Only Organizers can 'Add a new Task'</h3>
                <p>
                    Come back later to see if the organizer has added new tasks in this checklist.
                </p>
            </div>
        <?php
        endif;
    endif;
    ?>
</div>
<!-- /.row -->
