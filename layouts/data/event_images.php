<div class="tab-pane fade" id="event_images">

    <div class="row">
        <?php
        $images = Gallery::find_all_for_event($current_event->id);
        $imgCount = 0;
        while ($image = current($images)):
            ?>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <!--                <div class="panel-heading">
                                        <h3 class="panel-title">You can even have a Panel Title</h3>
                                    </div>-->
                    <div class="panel-image">
                        <a href="./view_image.php?image_id=<?php echo $image->id; ?>" target="_blank">
                            <img src="<?php echo $image->image_dir() . DS . $image->img; ?>" class="panel-image-preview" />
                        </a>
                    </div>
                    <div class = "panel-body">
                        <p>
                            <?php echo $image->note;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $imgCount++;
            next($images);
        endwhile;
        if ($imgCount < 1) :
            ?>
            <h2 class="panel-heading ">Sorry no images for this event yet.</h2>
            <?php
        endif;
        ?>

    </div>

    <?php
    if ($current_user->id == $current_event->organiser) :
        $object = new Gallery();
        ?>

        <div class="panel panel-default row">
            <h3 class="panel-heading text-capitalize">Insert new Image</h3>
            <form id="form" class="panel-body form-inline" method="post" action="tableForms/insert.php" enctype="multipart/form-data">

                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*" required/>

                <label class="col-form-label" for="note">Note</label>
                <input id="note" name="note" class="form-control" value="<?php echo $object->note; ?>"/>

                <input id="table_name" name="table_name" type="hidden" value="gallery"/>
                <input name="event" type="hidden" value="<?php echo $current_event->id; ?>"/>
                <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>

                <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
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
    <?php endif; ?>

</div>