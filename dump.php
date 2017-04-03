<?php

include './layouts/header.php';
/*
  ?>


  <ul>

  <?php
 * 
 */
$event = Event::find_by_id(1);

$event_type = isset($_POST['event_type']) ? $_POST['event_type'] : 0;

$legal = isset($_POST['legal']) ? $_POST['legal'] : false;
$agenda = isset($_POST['agenda']) ? $_POST['agenda'] : false;
$sound = isset($_POST['sound']) ? $_POST['sound'] : false;
$lights = isset($_POST['lights']) ? $_POST['lights'] : false;
$guest = isset($_POST['guest']) ? $_POST['guest'] : false;
$visuals = isset($_POST['visuals']) ? $_POST['visuals'] : false;
$decorations = isset($_POST['decorations']) ? $_POST['decorations'] : false;
$artist = isset($_POST['artist']) ? $_POST['artist'] : false;

switch ($event_type) {
    case 1:
        $checkLists = Created_Checklists::checklist_organisational($event, $legal, $agenda, $sound, $lights, $guest, $visuals, $decorations, $artist);
        break;

    default:
        $checkLists = Created_Checklists::checklist_primary($event, $sound, $lights, $guest, $visuals, $decorations, $artist);
        break;
}

echo json_encode($checkLists);

/*

    while ($list = current($checkLists)) {
        ?>
        <li>
            <?php echo $list->intro(); ?>
        </li>

        <?php
        next($checkLists);
    }
    ?>
</ul>

<?php include './layouts/footer.php'; ?>
 * 
 * 
 */