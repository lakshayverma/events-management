<?php
if (isset($_GET['id'])) {
    $object = EventReview::find_by_id($_GET['id']);
} else {
    $object = new EventReview();
}
?>

<div class="panel panel-default col-md-8 col-md-offset-2">
    <h3 class="panel-heading text-capitalize">Insert new Event Review</h3>

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
                include 'eventSelect.php'
                ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="col-form-label" for="user">Posted By</label>
            <select id="user" name="user" class="form-control" required>
                <?php
                $selected_user = $object->user;
                include 'userSelect.php';
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label" for="title">Title</label>
            <input id="title" name="title" class="form-control" type="text" value="<?php echo $object->title; ?>"  <?php echo ($object->title) ? '' : 'required'; ?>/>
        </div>

        <div class="form-group col-md-4">
            <label class="col-form-label" for="img">Image</label>
            <input id="img" name="img" class="form-control" type="file" accept="image/*"  <?php echo ($object->img) ? '' : 'required'; ?>/>
        </div>

        <div class="form-group col-md-4">
            <label class="col-form-label" for="rating">Rating</label>
            <select id="rating" name="rating" class="form-control">
                <?php
                $selected_rating = $object->rating;
                include 'ratingSelect.php';
                ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label class="col-form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" placeholder="A few words about the event" required><?php echo $object->description; ?></textarea>
        </div>
        <br>
        <div class="row btn-group-vertical col-md-6 col-md-offset-3">
            <input id="table_name" name="table_name" type="hidden" value="eventReview"/>
            <input id="posted_on" name="posted_on" class="form-control" type="hidden" value="<?php echo date("Y-m-d") . 'T' . date("h:i:s"); ?>" />
            <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
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