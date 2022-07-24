<?php
    class Model_Registration extends Model {
        function userReg() {
            // Страница регистрации нового пользователя 
            // Соединяемся с БД
            include '../config/db_connect.php';
            
            if(isset($_POST['registration'])) {
                $err = [];
                
                // проверяем логин
                if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])) {
                    $err[] = "Логин может состоять только из букв английского алфавита и цифр";
                } 
                
                if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
                    $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
                } 
                
                // проверяем, не существует ли пользователя с таким именем
                $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_log='".mysqli_real_escape_string($link, $_POST['login'])."'");
                
                if(mysqli_num_rows($query) > 0) {
                    $err[] = "Пользователь с таким логином уже существует в базе данных";
                } 
                
                // Если нет ошибок, то добавляем в БД нового пользователя
                if(count($err) == 0) {
                    $login = $_POST['login'];
                    // Убираем лишние пробелы и делаем двойное хэширование (используем старый метод md5)
                    $password = crypt($_POST['password'], 'UlTrAGyPeRsEcReT'); 
                    mysqli_query($link,"INSERT INTO users SET user_log='".$login."', user_pas='".$password."'");

                    //переадресовываем на страницу с сообщением об успехе
                    header("Location: ?url=regSuccessPage");

                    exit();
                } else {
                    print "<b>При регистрации произошли следующие ошибки:</b><br>";
                    foreach($err AS $error) {
                        print $error."<br>";
                    }
                    echo '<a class="reg_link" href="">Назад</a>';
                }
            }
        }
        
    }
?>