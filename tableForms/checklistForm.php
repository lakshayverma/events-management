<?php
if (isset($_GET['id'])) {
    $object = CheckList::find_by_id($_GET['id']);
} else {
    $object = new CheckList();
}
?>

<div class="panel panel-default col-md-8 col-md-offset-2">
    <h3 class="panel-heading text-capitalize">Insert new Checklist</h3>
    <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
        <?php if ($object->id): ?>
            <div class="form-group col-md-2">
                <label class="col-form-label" for="id">Id</label>
                <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
            </div>
        <?php endif; ?>
        <div class="form-group col-md-4">
            <label class="col-form-label" for="title">Title</label>
            <input id="title" name="title" class="form-control" type="text" value="<?php echo $object->title; ?>" required/>
        </div>
        <div class="form-group col-md-6">
            <label class="col-form-label" for="img">Image</label>
            <input id="img" name="img" class="form-control" type="file" accept="image/*" required/>
        </div>

        <div class="form-group col-md-6">
            <label class="col-form-label" for="user">Created BY</label>
            <select id="user" name="user" class="form-control" required>
                <?php
                $selected_user = $object->user;
                include 'userSelect.php';
                ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="col-form-label" for="event">Select an Event</label>
            <select id="event" name="event" class="form-control" required>
                <?php
                $selected_event = $object->event;
                include 'eventSelect.php';
                ?>
            </select>
        </div>
        <div class="row btn-group-vertical col-md-6 col-md-offset-3">
            <input id="table_name" name="table_name" type="hidden" value="checklist"/>
            <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
            <input id="created_on" name="created_on" class="form-control" type="hidden" value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
            <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
            <input class="form-control btn " type="reset" value="Clear"/>
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