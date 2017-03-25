<?php
if (isset($_GET['id'])) {
    $object = Item::find_by_id($_GET['id']);
} else {
    $object = new Item();
}
?>

<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Insert new Item</h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-6">
                <label class="col-form-label" for="title">Title</label>
                <input id="title" name="title" class="form-control" type="text"  required value="<?php echo $object->title; ?>" />
            </div>

            <div class="form-group col-md-4">
                <label class="col-form-label" for="type">Type</label>
                <input id="type" name="type" class="form-control" type="text"  required value="<?php echo $object->type; ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php echo ($object->img) ? '' : 'required'; ?>/>
            </div>
            <div class="form-group col-md-8">
                <label class="col-form-label" for="description">description</label>
                <textarea id="description" name="description" class="form-control" required><?php echo $object->description; ?></textarea>
            </div>

            <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="item"/>
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