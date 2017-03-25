<?php
$selected_user = (isset($selected_user)) ? $selected_user : 0;
$users = User::find_all();
while ($user = current($users)):
    ?>
    <option value="<?php echo $user->id; ?>" <?php echo ($selected_user == $user->id) ? 'selected' : ''; ?> >
        <?php echo $user->name(); ?>
    </option>

    <?php
    next($users);
endwhile;
?>