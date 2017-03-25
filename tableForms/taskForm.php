<?php
if (isset($_GET['id'])) {
    $object = Task::find_by_id($_GET['id']);
} else {
    $object = new Task();
}
?>
<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Create A Task</h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="title">Title</label>
                <input id="title" name="title" class="form-control" type="text" value="<?php echo $object->title; ?>" required />
            </div>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="checklist">Checklist</label>
                <select id="checklist" name="checklist" class="form-control" required>
                    <?php
                    $selected_checklist = $object->checklist;
                    include 'checklistSelect.php'
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="assigned_to">Assign To</label>
                <select id="assigned_to" name="assigned_to" class="form-control" required>
                    <?php
                    $selected_user = $object->assigned_to;
                    include 'userSelect.php'
                    ?>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="deadline">Deadline</label>
                <input id="deadline" name="deadline" class="form-control" type="<?php echo ($object->deadline) ? 'text' : 'datetime-local'; ?>" value="<?php echo $object->deadline; ?>" required/>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*"  <?php echo ($object->img) ? '' : 'required'; ?>/>
            </div>


            <div class="form-group col-md-4">
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

            <div class="form-group col-md-12">
                <label class="col-form-label" for="details">Details</label>
                <textarea id="details" name="details" class="form-control" required><?php echo $object->details; ?></textarea>
            </div>
            <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="task"/>
                <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
                <input class="form-control btn " type="reset" value="Clear"/>
            </div>
        </form>
    </div>
</div>

<script>
    var formRules = {
        rules: {
        },
        messages: {
        }
    };
</script>