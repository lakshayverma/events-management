<?php
$nav_only = TRUE;
$page_title = "Images";
include './layouts/header.php';
members_only();
if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
    $image = Gallery::find_by_id($id);
    if ($image->event) {
        $image_found = FALSE;
        if (Guest::is_guest($current_user->id, $image->event)) {
            $can_comment = TRUE;
        } else {
            $can_comment = FALSE;
            $msg = "You can not comment on the image.";
        }
    } else {
        $image_found = FALSE;
        $msg = "Image Not Found...";
    }
}
?>
<!-- Page Content -->
<article class="container-fluid">
    <div class="col-md-9">
        <section id="image_viewer">
            <img id="photograph" src="<?php echo $image->image_source(); ?>"/>
            <blockquote class="caption">
                <?php echo $image->note; ?>
            </blockquote>
        </section>
    </div>
    <aside id="img_comments" class="col-md-3 panel panel-default">
        <h2 class="panel-heading">Comments</h2>
        <section class="panel-body">
            <ul>
                <?php ?>
                <li>

                </li>
                <?php ?>
            </ul>
        </section>
        <form class="form-inline">
            <input type="text" class="form-control">
            <button type="submit" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-chat"></span>
                Comment
            </button>
        </form>
    </aside>
</article>

<?php include './layouts/footer.php'; ?>