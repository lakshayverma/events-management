<?php
if (isset($_GET['id'])) {
    $object = Friend::find_by_id($_GET['id']);
} else {
    $object = new Friend();
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
                <label class="col-form-label" for="perosn1">Person 1</label>
                <select id="person1" name="person1" class="form-control" required>
                    <?php
                    $selected_user = $object->person1;
                    include 'userSelect.php';
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="col-form-label" for="perosn2">Person 2</label>
                <select id="person2" name="person2" class="form-control" required>
                    <?php
                    $selected_user = $object->person2;
                    include 'userSelect.php';
                    ?>
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