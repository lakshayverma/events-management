<?php include './layouts/header.php'; ?>

<pre>
    <?php
    $events = Event::find_all();
    foreach ($events as $event) {
        echo "<br>";
        echo $event->name() . " ";
//        echo $event->can_be_rated();
        echo ($event->can_be_rated())?" Yes ": " No ";
    }
    ?>
</pre>


<?php include './layouts/footer.php'; ?>