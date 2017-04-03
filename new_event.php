<?php
$edit_records = FALSE;
$nav_only = TRUE;
$page_title = "Create A new Event";
include './layouts/header.php';
members_only();
$current_event = new Event();
$current_event->id = 0;
?>
<div class="container-fluid">
    <div class="panel panel-primary col-md-8 col-md-offset-2">
        <header class="panel-heading">
            <h3>
                <?= $page_title; ?>
            </h3>
        </header>
        <div class="panel-body">
            <?php $event = new Event(); ?>
            <form id="form" class="panel-body" method="post" action="./logic/create_event.php" enctype="multipart/form-data">
                <div class="row">
                    <legend>Basic Information</legend>
                    <div class="form-group col-md-5">
                        <label class="col-form-label" for="name">Event name</label>
                        <input tabindex="1" id="name" name="name" class="form-control" type="text" value="<?php echo $event->name; ?>" required/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="datetime">Date and Time</label>
                        <input tabindex="2" id="datetime" name="datetime" class="form-control"  type="datetime-local" value="<?php echo str_replace(" ", "T", $event->datetime); ?>"  required/>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="col-form-label" for="img">Image</label>
                        <input tabindex="4" id="img" name="img" class="form-control" type="file" accept="image/*" <?php echo ($event->img) ? '' : 'required'; ?>/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="description">Event Description</label>
                        <textarea tabindex="5" id="description" name="description" class="form-control" required><?php echo $event->description; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <legend class="col-form-label" for="item">Items</legend>
                        <select tabindex="6" id="item" name="item[]" class="form-control" multiple>
                            <?php $groups = Item::find_ordered(); ?>
                            <?php while ($group = current($groups)): ?>

                                <optgroup label="<?= ucwords(key($groups)) ?>">
                                    <?php while ($option = current($group)): ?>
                                        <option value="<?= $option["id"]; ?>" ><?= $option["title"]; ?></option>
                                        <?php
                                        next($group);
                                    endwhile;
                                    ?>
                                </optgroup>

                                <?php
                                next($groups);
                            endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <legend>Pre Created Checklists</legend>
                        <?php
                        $checklist_options = Created_Checklists::available_checklists();

                        while ($list_option = current($checklist_options)) {
                            ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="<?= $list_option; ?>"> <?= ucwords($list_option); ?>(s) Management List</label>
                            </div>

                            <?php
                            next($checklist_options);
                        }
                        ?>


                        <!--<label class = "col-form-label" for = "checklists">Pre created checklists</label>
                        <select tabindex = "7" id = "checklists" name = "checklists" class = "form-control" multiple>
                        <?php
//                            $options = CheckList::find_precreated();
//                            include './layouts/data/options_list.php';
                        ?>
                        </select>                -->
                    </div>
                </div>

                <div class="row ">
                    <input id="organiser" name="organiser" type="hidden" value="<?php echo $current_user->id; ?>">
                    <input id="table_name" name="table_name" type="hidden" value="event"/>
                    <input tabindex="8" class="form-control btn btn-primary" type="submit" value="Submit"/>
                    <input tabindex="9" class="form-control btn " type="reset" value="Clear"/>
                </div>

            </form>


            <script>
                var formRules = {
                    rules: {
                    },
                    messages: {
                    }
                };
            </script>
        </div>

    </div>
</div>
</div>

<?php include './layouts/footer.php' ?>