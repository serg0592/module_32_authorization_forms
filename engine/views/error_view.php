<?php
    session_start();
    echo "<h4>Возникли следующие ошибки:</h4>";
    foreach($_SESSION['err'] AS $error) {
        echo $error."<br>";
    };
    session_destroy();
    echo '<br><a class="reg_link" href="?url=main">Назад</a>';
?>