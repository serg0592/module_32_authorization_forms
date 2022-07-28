<?php
    echo "Возникли следующие ошибки:<br>";
    foreach($_SESSION['err'] AS $error) {
        echo $error."<br>";
    };
    session_destroy();
    echo '<a class="reg_link" href="?url=main">Назад</a>';
?>