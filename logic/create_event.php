<?php

require_once './../includes/initialize.php';

$event = new Event();
$attrs = $event->attributes();

foreach ($_POST as $attribute => $value) {
    if ($attribute == "table_name" || $attribute == "id") {
        continue;
    }
    if (array_key_exists($attribute, $attrs) && !empty($value)) {
        $event->$attribute = $value;
    } else if (property_exists($event, $attribute)) {
        $event->$attribute = $value;
    }
}
if ($event->validate_attributes($event->insertion_attributes())) {

    if (!empty($_FILES['img']['name'])) {
        $event->img = $event->upload_img($_FILES['img']);
    }
    $event->save();
    if ($event->id) {
        $event_type = isset($_POST['event_type']) ? $_POST['event_type'] : 0;

        $agenda = isset($_POST[Created_Checklists::AGENDA]) ? get_checkbox_value($_POST[Created_Checklists::AGENDA]) : false;
        $artist = isset($_POST[Created_Checklists::ARTIST]) ? get_checkbox_value($_POST[Created_Checklists::ARTIST]) : false;
        $decorations = isset($_POST[Created_Checklists::DECORATIONS]) ? get_checkbox_value($_POST[Created_Checklists::DECORATIONS]) : false;
        $guest = isset($_POST[Created_Checklists::GUEST]) ? get_checkbox_value($_POST[Created_Checklists::GUEST]) : false;
        $legal = isset($_POST[Created_Checklists::LEGAL]) ? get_checkbox_value($_POST[Created_Checklists::LEGAL]) : false;
        $lights = isset($_POST[Created_Checklists::LIGHTS]) ? get_checkbox_value($_POST[Created_Checklists::LIGHTS]) : false;
        $sound = isset($_POST[Created_Checklists::SOUND]) ? get_checkbox_value($_POST[Created_Checklists::SOUND]) : false;
        $visuals = isset($_POST[Created_Checklists::VISUAL]) ? get_checkbox_value($_POST[Created_Checklists::VISUAL]) : false;

        $checkLists = Created_Checklists::checklist_organisational($event, $legal, $agenda, $sound, $lights, $guest, $visuals, $decorations, $artist);
        while ($m_c_list = current($checkLists)) {
            $m_c_list->save();
            next($checkLists);
        }


        $items = array();
        $selected_items = (isset($_POST['item'])) ? $_POST['item'] : false;
        if ($selected_items) {
            while ($item_select = current($selected_items)) {
                $my_item = EventItem::make($event->id, $item_select, "Pre selected in package.");
                $my_item->save();
                $items[] = $my_item;
                next($selected_items);
            }
        }
    }
    $redirect_url = "../view_event.php?event={$event->id}";

//    echo $redirect_url;
//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';

//    echo '<pre>';
//    print_r($checkLists);
//    print_r($items);
//    echo '</pre>';
    redirect_to($redirect_url);
} else {
    echo 'Errors';
}

