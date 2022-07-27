<?php
    echo "<h3>Возникли следующие ошибки:</h3><br>";
    foreach($_SESSION['err'] AS $error) {
        echo $error."<br>";
    };
    echo '<a class="reg_link" href="">Назад</a>';
?>