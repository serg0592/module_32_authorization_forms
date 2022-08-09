<?php
    class Model_LogOut extends Model {
        // скрипт разавторизации
        function logoutUser() {
            session_start();
            // Соединяемся с БД
            include '../config/db_connect.php';

            //проверяем наличие куки (хэш, id)
            if (isset($_COOKIE['authHash']) && isset($_COOKIE['id'])) {
                //удаляем хэш авторизации из БД

                mysqli_query(
                    $link, "UPDATE users 
                    SET user_authHash='".null."' WHERE id='".intval($_COOKIE['id'])."'"
                );

                // Удаляем куки
                setcookie("id", "", time() - 1, '/');
                setcookie("authHash", "", time() - 1, '/'); // httponly !!!

            //если нет куки, проверяем хэш в сессии (пользователь "не запоминал" себя)
            } elseif (isset($_SESSION['authHash'])) {
                //удаляем хэш авторизации из БД
                mysqli_query(
                    $link, "UPDATE users 
                    SET user_authHash='".null."' WHERE id='".intval($_SESSION['id'])."'"
                );
                //очищаем $_SESSION
                $_SESSION['id'] = null;
                $_SESSION['login'] = null;
                $_SESSION['password'] = null;
                $_SESSION['authHash'] = null;
                //удаляем куки сессии
                setcookie("PHPSESSID", '', time() - 3600, '/');

                session_destroy();

            //если нет хэша в сессии, проверяем токен VK OAuth (пользователь авторизовался через VK)
            } elseif ($_SESSION['VKoauthToken']) {
                //очищаем $_SESSION
                $_SESSION['VKoauthToken'] = null;
                $_SESSION['userData'] = null;
                $_SESSION['first_name'] = null;
                $_SESSION['last_name'] = null;
                //удаляем куки сессии
                setcookie("PHPSESSID", '', time() - 3600, '/');

                session_destroy();
            };
            
            //Переходим на главную страницу
            header("Location: ?url=main");
            exit();
        }
    }
?>