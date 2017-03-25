<?php
$nav_only = TRUE;
$page_title = "Images";
include './layouts/header.php';
members_only();
if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
    $image = Gallery::find_by_id($id);
    if ($image->event) {
        $image_found = TRUE;
        if (Guest::is_guest($current_user->id, $image->event)) {

            $can_comment = TRUE;
            $comments = $image->get_comments();
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
    <?php if ($image_found): ?>
        <div class="col-md-9">
            <section id="image_viewer">
                <img id="photograph" src="<?php echo $image->image_source(); ?>"/>
                <blockquote class="caption">
                    <?php echo $image->note; ?>
                </blockquote>
            </section>
        </div>
        <?php if ($can_comment): ?>
            <aside id="img_comments" class="col-md-3 panel panel-primary">
                <h2 class="panel-heading">Comments</h2>
                <section class="panel-body">
                    <ul class="list-group">
                        <?php
                        while ($comment = current($comments)):
                            ?>
                            <li class="list-group-item row">
                                <div class="col-md-4">
                                    <?php echo $comment->get_user()->avatar("64px", "img img-thumbnail zoom-img stay"); ?>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $comment->comment; ?>
                                </div>
                            </li>
                            <?php
                            next($comments);
                        endwhile;
                        ?>
                    </ul>
                </section>
                <form class="form-inline" method="post" action="./logic/comment.php">
                    <input name="comment" type="text" class="form-control">
                    <input name="image" type="hidden" value="<?php echo $image->id; ?>"/>
                    <input name="redirect_url" type="hidden" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-chat"></span>
                        Comment
                    </button>
                </form>
            </aside>
        <?php endif; ?>
    <?php endif; ?>
</article>
<?php include './layouts/footer.php'; ?>