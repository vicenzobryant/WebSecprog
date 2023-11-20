<?php
    require "./db.php";

    $conn = new mysqli(
        $conf['server'],
        $conf['username'],
        $conf['password'],
        $conf['database']
    )

?>