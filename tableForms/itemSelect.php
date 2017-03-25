<?php
$selected_item = (isset($selected_item)) ? $selected_item : 1;
$items = Item::find_all();
while ($item = current($items)):
    ?>
    <option value="<?php echo $item->id; ?>" <?php echo ($selected_item == $item->id) ? 'selected' : ''; ?>>
        <?php echo $item->name(); ?>
    </option>

    <?php
    next($items);
endwhile;
?>
