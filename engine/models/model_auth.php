<?php
    session_start();
    if($_POST["token"] == $_SESSION["CSRF"]) {
        if((isset($_POST["login"]))&& (isset($_POST["pass"]))) {
            include '../config/db_connect.php';
            $result = mysqli_query($link, "SELECT * FROM users WHERE user_log = '".$_POST["login "]."' 
                                    AND user_pas = '".$_POST["pass"]."'");
        
            if(mysqli_num_rows($result) > 0) {
                // логин и пароль нашли
                $_SESSION["isauth"] = true;
            } else {
                //Отображаем сообщение, что логин и пароль не найдены
                echo 'Неверный логин/пароль';
            };    
        };
    };
?>