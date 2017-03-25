<?php
$selected_checklist = (isset($selected_checklist)) ? $selected_checklist : 1;
$checkLists = CheckList::find_all();
while ($checklist = current($checkLists)):
    ?>
    <option value="<?php echo $checklist->id; ?>"  <?php echo ($selected_checklist == $checklist->id) ? 'selected' : ''; ?> >
        <?php echo $checklist->name(); ?>
    </option>

    <?php
    next($checkLists);
endwhile;
?>
