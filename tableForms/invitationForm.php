<?php
$tbClass = ucfirst($table);
if (isset($_GET['id'])) {
    $object = $tbClass::find_by_id($_GET['id']);
} else {
    $object = new $tbClass();
}
$object->init_members();
?>

<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Insert new <?php echo $table; ?></h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-5">
                <label class="col-form-label" for="user">Invite</label>
                <select id="user" name="user" class="form-control" required>
                    <?php
                    $selected_user = $object->user;
                    include 'userSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="col-form-label" for="event">Select an Event</label>
                <select id="event" name="event" class="form-control" required>
                    <?php
                    $selected_event = $object->event;
                    include 'eventSelect.php';
                    ?>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label class="col-form-label" for="message">Message</label>
                <textarea id="message" name="message" class="form-control" required><?php echo $object->message; ?></textarea>
            </div>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="position">Position</label>
                <select id="position" name="position" class="form-control">
                    <?php
                    $options_guest = array('Guest of Honor', 'V.I.P', 'Guest', 'Member', 'Admin');
                    foreach ($options_guest as $option):
                        ?>
                        <option value="<?php echo $option; ?>"
                                <?php echo ($option === $object->guestObj->position) ? 'selected' : ''; ?> >
                                    <?php echo $option; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="status">Invitation Status</label>
                <select id="status" name="status" class="form-control">
                    <?php
                    $options_invite = array('Attending', 'Not Attending', 'May Be');
                    foreach ($options_invite as $option):
                        ?>
                        <option value="<?php echo $option; ?>"
                                <?php echo ($option === $object->guestObj->status) ? 'selected' : ''; ?> >
                                    <?php echo $option; ?>
                        </option>
                    <?php endforeach; ?>

                </select>
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