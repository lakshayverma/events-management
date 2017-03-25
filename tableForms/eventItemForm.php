<?php
if (isset($_GET['id'])) {
    $object = EventItem::find_by_id($_GET['id']);
} else {
    $object = new EventItem();
}
?>


<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Book Item for event.</h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">

            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="event">Event</label>
                <select id="event" name="event" class="form-control" required>
                    <?php
                    $selected_event = $object->event;
                    include 'eventSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="item">Item</label>
                <select id="item" name="item" class="form-control" required>
                    <?php
                    $selected_item = $object->item;
                    include 'itemSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="col-form-label" for="note">Note</label>
                <textarea id="note" name="note" class="form-control"><?php echo $object->note; ?></textarea>
            </div>

            <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="eventItem"/>
                <input id="bookedOn" name="bookedOn" class="form-control" type="hidden"  value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
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
