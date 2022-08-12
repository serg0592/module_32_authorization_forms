<?php
    class Model_Registration extends Model {
        function userReg() {
            // Страница регистрации нового пользователя 
            // Соединяемся с БД
            include_once '../config/db_connect.php';
            include_once '../config/logger.php';
            $err = 0;
            
            if(isset($_POST['registration'])) {                
                // проверяем логин
                if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])) {
                    $err++;
                    $log->error('Логин может состоять только из букв английского алфавита и цифр');
                } 
                
                if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
                    $err++;
                    $log->error('Логин должен быть не меньше 3-х символов и не больше 30');
                } 
                
                // проверяем, не существует ли пользователя с таким именем
                $query = mysqli_query($link, "SELECT id FROM users 
                                    WHERE user_log='".mysqli_real_escape_string($link, $_POST['login'])."'");
                
                if(mysqli_num_rows($query) > 0) {
                    $err++;
                    $log->error('Пользователь с таким логином уже существует в базе данных');
                } 
                
                // Если нет ошибок, то добавляем в БД нового пользователя
                if($err == 0) {
                    $login = $_POST['login'];
                    // Убираем лишние пробелы и делаем хэширование методом crypt
                    $password = crypt($_POST['password'], 'UlTrAGyPeRsEcReT'); 
                    mysqli_query($link,"INSERT INTO users SET user_log='".$login."', user_pas='".$password."', role='guest'");

                    //переадресовываем на страницу с сообщением об успехе
                    header("Location: ?url=authorized");
                    exit();
                } else {
                    header('Location: ?url=check');
                }
            }
        }
        
    }
?>