<?php

require_once(LIB_PATH . DS . "checklist.php");

class Created_Checklists {

    const AGENDA = 'agenda';
    const ARTIST = 'artist';
    const DECORATIONS = 'decorations';
    const GUEST = 'guest';
    const LEGAL = 'legal';
    const LIGHTS = 'light';
    const SOUND = 'sound';
    const VISUAL = 'visual';

    public static function available_checklists() {
        $array = array(self::AGENDA, self::ARTIST, self::DECORATIONS, self::GUEST, self::LEGAL, self::LIGHTS, self::SOUND, self::VISUAL);
        return $array;
    }

    public static function checklist_primary($event, $sound = TRUE, $lights = TRUE, $guest = TRUE, $visuals = TRUE, $decorations = TRUE, $artist = TRUE) {
        global $session;
        $current_user = $session->get_user_object();
        $lists = array();
        if ($sound) {
            $lists[] = CheckList::make("Sound", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "microphone.png");
        }
        if ($lights) {
            $lists[] = CheckList::make("Lights and Electricity", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "light-bulb.png");
        }

        if ($guest) {
            $lists[] = CheckList::make("Guest Management", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "guests.png");
        }
        if ($visuals) {
            $lists[] = CheckList::make("Party Visuals", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "confetti.png");
        }
        if ($decorations) {
            $lists[] = CheckList::make("Party Decorations", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "party.png");
        }
        if ($artist) {
            $lists[] = CheckList::make("Artist", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "singer.png");
        }
        return $lists;
    }

    public static function checklist_organisational($event, $legal = TRUE, $agenda = TRUE, $sound = TRUE, $lights = TRUE, $guest = TRUE, $visuals = TRUE, $decorations = TRUE, $artist = TRUE) {
        global $session;
        $current_user = $session->get_user_object();
        $lists = static::checklist_primary($event, $sound, $lights, $guest, $visuals, $decorations, $artist);
        if ($legal) {
            $lists[] = CheckList::make("Legal Docs", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "contract.png");
        }
        if ($agenda) {
            $lists[] = CheckList::make("Agenda", $current_user->id, $event->id, date("Y-m-d H:i:s"), "defaults" . DS . "notebook.png");
        }
        return $lists;
    }

}
