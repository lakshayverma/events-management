<?php
$custom_header = TRUE;
$custom_footer = TRUE;
$edit_records = FALSE;
$page_title = "Checklist";
include './layouts/header.php';
$current_list = (isset($_GET['list'])) ? $_GET['list'] : 0;
$current_list = CheckList::find_by_id($current_list);
$current_event = $current_list->get_event();
$guest = Guest::is_guest($current_user->id, $current_event->id);
$guest = array_shift($guest);
$position = strtolower($guest->position);

if ($position == 'admin' || $position == 'member' || $current_event->organiser == $current_user->id) {
    include './layouts/data/checklist_renderer.php';
} else {
    ?>
    <div class="container-fluid">
        <div class="panel panel-danger">
            <h1 class="panel-heading">
                Restricted!!
            </h1>
            <p class="panel-body">
                "You are a <strong class="text-capitalize"><?php echo $position; ?> </strong> and only Organizer or Members of event are allowed to see checklists."
            </p>
        </div>
    </div>
    <?php
}
include './layouts/footer.php'
?>