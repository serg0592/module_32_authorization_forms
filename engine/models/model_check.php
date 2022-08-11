<?php
    class Model_Check extends Model {
        // Скрипт проверки 
        function checkUser() {
            include_once '../config/logger.php';
            session_start();
            // Соединяемся с БД
            include '../config/db_connect.php';
            
            //проверяем наличие куки с id и хэшем авторизации
            if (isset($_COOKIE['id']) && isset($_COOKIE['authHash'])) {
                $query = mysqli_query(
                    $link, "SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1"
                );
                $userdata = mysqli_fetch_assoc($query);
            
                //проверяем соответствие хэша авторизации и id в БД с хэшом авторизации и id в cookie
                if(($userdata['user_authHash'] !== $_COOKIE['authHash']) or ($userdata['id'] !== $_COOKIE['id'])) {
                    $log->error('Не соответствует хэш авторизации / id пользователя (куки)');
                    exit();
                } else {
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!(куки)";
                    $_SESSION['role'] = $userdata['role'];
                    header("Location: ?url=authSuccess");
                    exit();
                };


            //если куки не установлены, проверяем наличие в сессии хэша авторизации и логина(пользователь не "запоминал себя")
            } elseif (isset($_SESSION['authHash']) && isset($_SESSION['login'])) {
                $query = mysqli_query(
                    $link, "SELECT * FROM users 
                    WHERE user_log = '".mysqli_real_escape_string($link, $_SESSION['login'])."' LIMIT 1"
                );
                $userdata = mysqli_fetch_assoc($query);
            
                //проверяем соответствие хэша авторизации и логина в БД с хэшом авторизации и логина в сессии
                if(($userdata['user_authHash'] !== $_SESSION['authHash']) 
                        or ($userdata['user_log'] !== $_SESSION['login'])) {
                    $log->error('Не соответствует хэш авторизации / логин пользователя (сессия)');
                    exit();
                } else {
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!(сессия)";
                    $_SESSION['role'] = $userdata['role'];
                    header("Location: ?url=authorized");
                    exit();
                };

            //если в сессии нет хэша авторизации и логина, то проверяем наличие VK-токена
            } elseif (isset($_SESSION['VKoauthToken'])) {
                $_SESSION['message'] = "Привет, ".$_SESSION['first_name']." ".$_SESSION['last_name']." !(VK OAuth)";
                $_SESSION['role'] = 'VK';
                header("Location: ?url=authorized");
                exit();
                
            } else {
                $log->error('Нет авторизованных пользователей');
                header("Location: ?url=main");
                exit();
            };
        }
    }
?>