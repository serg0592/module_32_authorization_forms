<?php
    class Model_Auth extends Model {
        //генерация случайной строки (для хэша авторизации)
        public function generateCode($length) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
            $code = "";
            $clen = strlen($chars) - 1;
            while (strlen($code) < $length) {
                    $code .= $chars[mt_rand(0,$clen)];
            }
            return $code;
        }
        
        //авторизация пользователя
        public function userAuth() {
            //session_start();
            // Соединяемся с БД
            include '../config/db_connect.php';
            // Вытаскиваем из БД запись, у которой логин равняется введенному
            $query = mysqli_query(
                $link, "SELECT user_id, user_pas FROM users 
                WHERE user_log='".mysqli_real_escape_string($link, $_POST['login'])."' LIMIT 1"
            );
            $data = mysqli_fetch_assoc($query); 
            
            if(isset($data['user_id'])) {
                // Сравниваем пароли
                if($data['user_pas'] === crypt($_POST['password'], 'UlTrAGyPeRsEcReT')) {
                    //проверка чек-бокса "запомнить меня"
                    if ($_POST['rememberUser'] === 'remember') {
                        // Генерируем случайное число хэша авторизации и шифруем его
                        $authHash = md5($this->generateCode(13));

                        // Записываем в БД новый хеш авторизации
                        mysqli_query(
                            $link, "UPDATE users 
                            SET user_authHash='".$authHash."' WHERE user_id='".$data['user_id']."'"
                        );

                        // Ставим куки (живут 5 минут)
                        //id пользователя
                        setcookie(
                            "id", $data['user_id'], time()+60*5, "/", "localhost", false, true
                        );
                        //хэш авторизации
                        setcookie(
                            "authHash", $authHash, time()+60*5, "/", "localhost", false, true
                        ); // httponly!
                    };

                    // Переадресовываем браузер на страницу проверки нашего скрипта
                    header("Location: ?url=check");
                    
                } else {
                    $_SESSION['err'][] = 'Неверный пароль';
                    header('Location: ?url=error');
                }
            } else {
                $_SESSION['err'][] = 'Неверный логин';
                header('Location: ?url=error');
            }
        }
    }
?>