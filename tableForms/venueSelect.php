<?php
$selected_venue = (isset($selected_venue)) ? $selected_venue : 1;

$venues = Venue::find_all();
while ($venue = current($venues)):
    ?>
    <option value="<?php echo $venue->id; ?>" <?php echo ($selected_venue == $venue->id) ? 'selected' : ''; ?>>
        <?php echo $venue->name(); ?>
    </option>

    <?php
    next($venues);
endwhile;
?>