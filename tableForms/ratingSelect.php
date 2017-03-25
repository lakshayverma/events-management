<?php
$options_rate = array('Fantastic', 'Great', 'Good', 'Average', 'Below Average', 'Poor');
foreach ($options_rate as $option):
    ?>
    <option value="<?php echo $option; ?>"
            <?php echo ($option === $selected_rating) ? 'selected' : ''; ?> >
                <?php echo $option; ?>
    </option>
<?php endforeach; ?>