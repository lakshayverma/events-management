<article class="panel panel-primary">
    <h1 class="panel-heading">All Tables</h1>
    <?php
    $tables = get_all_tables();

    foreach ($tables as $table) :
        $db_fields = "array(";
        ?>
        <p>
            // If it is going to need the database, then it is probably smart to require it before we start.
            <br>
            require_once(LIB_PATH . DS . "database.php");
            <br>
            class <?php echo $table["name"]; ?> extends DatabaseObject{
            <br>
            protected static $table_name = "<?php echo $table["name"]; ?>";
            <?php foreach ($table["columns"] as $column): ?>
                <br />public $<?php echo $column; ?>;
                <?php
                $db_fields .= "'$column',";

            endforeach;
            $db_fields .= ")"
            ?>

            protected static $db_fields = <?php echo $db_fields; ?>;


            }
        </p>
        <?php
    endforeach;
    ?>
</article>