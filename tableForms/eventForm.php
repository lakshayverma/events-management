<?php
if (isset($_GET['id'])) {
    $object = Event::find_by_id($_GET['id']);
} else {
    $object = new Event();
}
?>

<div class="container-fluid">
    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Insert new Event</h3>
        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>
            <div class="form-group col-md-5">
                <label class="col-form-label" for="organiser">Organizer</label>
                <select id="organiser" name="organiser" class="form-control" required>
                    <?php
                    $selected_user = $object->organiser;
                    include 'userSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="col-form-label" for="name">Event name</label>
                <input id="name" name="name" class="form-control" type="text" value="<?php echo $object->name; ?>" required/>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="datetime">Date and Time</label>
                <input id="datetime" name="datetime" class="form-control" type="datetime-local" value="<?php echo str_replace(" ", "T", $object->datetime); ?>"  required/>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php echo ($object->img) ? '' : 'required'; ?>/>
            </div>
            <div class="form-group col-md-12">
                <label class="col-form-label" for="description">Event Description</label>
                <textarea id="description" name="description" class="form-control" required><?php echo $object->description; ?></textarea>
            </div>
            <br>

            <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="event"/>
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