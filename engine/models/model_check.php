<?php
    class Model_Check extends Model {
        function checkUser() {
            session_start();
            $_SESSION[] = $err[];
            // Скрипт проверки 
            // Соединяемся с БД
            include '../config/db_connect.php';
            
            if (isset($_COOKIE['id']) and isset($_COOKIE['authHash']))
            {
                $query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                $userdata = mysqli_fetch_assoc($query);
            
                if(($userdata['user_authHash'] !== $_COOKIE['authHash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                    //удалить куки указанием времени из прошлого ( - 1 час)
                    setcookie("id", $userdata['user_id'], time() - 60*60);
                    setcookie("authHash", $userdata['user_authHash'], time() - 60*60);
                    //переход на страницу с выводом ошибок
                    header('Location: ?url=error');
                    exit();
                }
                else
                {
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!";
                    header("Location: ?url=gallery_auth");
                    exit();
                };
            }
            else
            {
                header('Location: ?url=cookie');
            };
        }
    }
?>