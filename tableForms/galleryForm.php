<?php
$tbClass = ucfirst($table);
if (isset($_GET['id'])) {
    $object = $tbClass::find_by_id($_GET['id']);
} else {
    $object = new $tbClass();
}
?>

<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Insert new <?php echo $table; ?> Image</h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">

            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="event">Select an Event</label>
                <select id="event" name="event" class="form-control" required>
                    <?php
                    $selected_event = $object->event;
                    include 'eventSelect.php';
                    ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*" required/>
            </div>

            <div class="form-group col-md-12">
                <label class="col-form-label" for="note">Note</label>
                <textarea id="note" name="note" class="form-control" rows="5"><?php echo $object->note; ?></textarea>
            </div>

            <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="<?php echo $table; ?>"/>
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