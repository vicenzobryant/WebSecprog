<?php
    require "../Config/database.php";

    $conn = new mysqli(
        $conf['server'],
        $conf['username'],
        $conf['password'],
        $conf['database']
    )

?>