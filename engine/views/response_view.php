<?php
    echo "id(DB)         = " . $_SESSION['id']."<br>";
    echo "log(DB)        = " . $_SESSION['login']."<br>";
    echo "password(DB)   = " . $_SESSION['password']."<br>";
    echo "auth hash(DB)  = " . $_SESSION['authHash']."<br>";
    echo "data           = " . $_SESSION['data']."<br>";
    echo "auth token(VK) = " . $_SESSION['VKoauthToken']."<br>";
    var_dump($_SESSION['response']);
    var_dump($_SESSION['userData']);
    echo "<br>";
    if(!isset($_SESSION['userData'])) {
        echo "<a href='?url=getVKUserdata'>Получить имя/фамилию</a>";
    };
?>