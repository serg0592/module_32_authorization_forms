<?php
    $host = 'localhost';
    $log = 'root';
    $pas = '';
    $db_name = '32_practice';

    $connection = mysqli_connect($host, $log, $pas);

    mysqli_select_db($db, $connection);
    if (!$connection || !mysqli_select_db($db, $connection)) {
        exit(mysqli_error(0));
    };
?>