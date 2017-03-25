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
        <h3 class="panel-heading text-capitalize">Insert new <?php echo $table; ?></h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-5">
                <label class="col-form-label" for="image">Image</label>
                <select id="image" name="image" class="form-control" required>
                    <?php
                    $options = Gallery::find_all();
                    $selected_option = $object->image;
                    include './layouts/data/options_list.php';
                    ?>
                </select>
            </div>

            <div class="form-group col-md-5">
                <label class="col-form-label" for="user">Commented By</label>
                <select id="user" name="user" class="form-control" required>
                    <?php
                    $selected_user = $object->user;
                    include 'userSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="col-form-label" for="datetime">Comment On</label>
                <input id="datetime" name="datetime" type="datetime-local" class="form-control" value="<?php echo DatabaseObject::form_date($object->datetime); ?>" required>
            </div>
            <div class="form-group col-md-7">
                <label class="col-form-label" for="comment">Comment</label>
                <textarea id="comment" name="comment" class="form-control" required><?php echo $object->comment; ?></textarea>
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