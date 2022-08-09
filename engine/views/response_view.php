<?php
    if(!isset($_SESSION['userData'])) {
        echo "<a href='?url=getVKUserdata'>Получить имя/фамилию</a>";
    };
?>