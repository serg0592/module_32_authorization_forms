<?php
    class Model_Check extends Model {
        function checkUser() {
            session_start();
            // Скрипт проверки 
            // Соединяемся с БД
            include '../config/db_connect.php';
            
            //проверяем наличие куки с id и хэшем авторизации
            if (isset($_COOKIE['id']) and isset($_COOKIE['authHash']))
            {
                $query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                $userdata = mysqli_fetch_assoc($query);
            
                //проверяем соответствие хэша авторизации и id в БД с хэшом авторизации и id в cookie
                if(($userdata['user_authHash'] !== $_COOKIE['authHash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                    $_SESSION['err'][] = 'Не соответствует хэш авторизации / id пользователя';
                    //переход на страницу с выводом ошибок
                    header('Location: ?url=error');
                    exit();
                } else {
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!";
                    header("Location: ?url=authorized");
                    exit();
                };
            } else {
                $_SESSION['err'][] = 'Куки не найдены';
                header('Location: ?url=error');
                exit();
            };
        }
    }
?>