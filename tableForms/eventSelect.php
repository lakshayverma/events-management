<?php
$selected_event = (isset($selected_event)) ? $selected_event : 1;
$events = Event::find_all();
while ($event = current($events)):
    ?>
    <option value="<?php echo $event->id; ?>" <?php echo ($selected_event == $event->id) ? 'selected' : ''; ?>>
        <?php echo $event->name(); ?>
    </option>

    <?php
    next($events);
endwhile;
?>
