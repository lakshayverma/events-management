<?php if ($current_user->id == $current_event->organiser) : ?>
    <div class="tab-pane fade" id="event_edit">
        <?php $object = $current_event; ?>
        <div class="panel panel-default">
            <form id="new_event_form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">

                <div class="form-group col-md-3">
                    <label class="col-form-label" for="name">Event name</label>
                    <input id="name" name="name" class="form-control" type="text" value="<?php echo $object->name; ?>" required/>
                </div>
                <div class="form-group col-md-5">
                    <label class="col-form-label" for="datetime">Date and Time</label>
                    <input id="datetime" name="datetime" class="form-control" type="datetime-local" value="<?php echo str_replace(" ", "T", $object->datetime); ?>" required/>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="img">Image</label>
                    <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php echo ($object->img) ? '' : 'required'; ?>/>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-form-label" for="description">Event Description</label>
                    <textarea id="description" rows="8" name="description" class="form-control" required><?php echo $object->description; ?></textarea>
                </div>
                <br>

                <div class="row btn-group-vertical col-md-6 col-md-offset-3">
                    <input name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                    <input id="id" name="id" class="form-control" type="hidden" readonly value="<?php echo $object->id; ?>"/>
                    <input id="organiser" name="organiser" type="hidden" value="<?php echo $current_user->id; ?>">
                    <input id="table_name" name="table_name" type="hidden" value="event"/>
                    <input class="form-control btn  btn-primary" type="submit" value="Submit"/>
                    <input class="form-control btn " type="reset" value="Clear"/>
                </div>

            </form>
        </div>
    </div>
<?php endif; ?>