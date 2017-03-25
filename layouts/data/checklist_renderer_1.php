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
            $user = $task->get_user();
            ?>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-default btn-block" 
                    data-toggle="modal" data-target="#taskModal-<?php echo $task->id; ?>">
                        <?php echo $task->avatar("48px"); ?><?php echo $task->name(); ?>
            </button>

            <!-- Modal -->
            <div id="taskModal-<?php echo $task->id; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo $task->name(); ?></h4>
                        </div>
                        <div class="modal-body">
                            <div><?php echo $task->details; ?></div>
                            <hr>
                            <div>
                                    <button value="Assigned" class="btn btn-sm">Assigned</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php echo $user->avatar("32px", "img img-thumbnail zoom-img") . " " . $user->name(); ?>
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        </div>
                    </div>

                </div>
            </div>
            <?php
            next($tasks);
        }
        ?>
    </div>

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
</div>
<!-- /.row -->
