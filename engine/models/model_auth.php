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
            session_start();
            $_SESSION['login'] =& $_POST['login'];
            $_SESSION['password'] =& $_POST['password'];

            // Соединяемся с БД
            include '../config/db_connect.php';

            // Вытаскиваем из БД запись, у которой логин равняется введенному
            $query = mysqli_query(
                $link, "SELECT id, user_pas, user_log FROM users 
                WHERE user_log='".mysqli_real_escape_string($link, $_POST['login'])."' LIMIT 1"
            );
            $data = mysqli_fetch_assoc($query); 
            
            //если найден id в БД
            if(isset($data['id'])) {
                //запишем в сессию id пользователя
                $_SESSION['id'] =& $data['id'];

                // Сравниваем пароли
                if($data['user_pas'] === crypt($_POST['password'], 'UlTrAGyPeRsEcReT')) {
                    // Генерируем случайное число хэша авторизации и шифруем его
                    $authHash = md5($this->generateCode(13));

                    // Записываем в БД новый хеш авторизации
                    mysqli_query(
                        $link, "UPDATE users 
                        SET user_authHash='".$authHash."' WHERE id='".$data['id']."'"
                    );

                    //проверка чек-бокса "запомнить меня"
                    if ($_POST['rememberUser'] === 'remember') {
                        //если "запомнить", ставим куки (живут 1 день)
                        //id пользователя
                        setcookie(
                            "id", $data['id'], time()+60*60*24, "/", "localhost", false, true
                        );
                        //хэш авторизации
                        setcookie(
                            "authHash", $authHash, time()+60*60*24, "/", "localhost", false, true
                        ); // httponly!
                    } else {
                        //если нет "запомнить", записываем хэш в сессию
                        $_SESSION['authHash'] =& $authHash;
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