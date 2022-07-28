<?php
    class Model_LogOut extends Model {
        function logoutUser() {
            // Страница разавторизации
            // Соединяемся с БД
            include '../config/db_connect.php';

            //удаляем хэш авторизации из БД
            mysqli_query(
                $link, "UPDATE users 
                SET user_authHash='".$_COOKIE['authHash']."' WHERE user_id='".$_COOKIE['id']."'"
            );

            // Удаляем куки
            setcookie("id", "", time() - 60*60);
            setcookie("hash", "", time() - 60*60); // httponly !!!

            //удаляем сессию
            session_destroy();
            
            //Переходим на главную страницу
            header("Location: ?url=main");
        }
    }
?>