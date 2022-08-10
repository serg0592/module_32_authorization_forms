<?php
    class Model_Get_VK_Userdata extends Model {
        public function get_VK_userdata() {
            session_start();
            //берем токен из сессии
            $token =& $_SESSION['VKoauthToken'];
            $userId =& $_SESSION['VKuserId'];

            $params = array(
                'v' => '5.131', // Версия API
                'access_token' => $token, // Токен
                'user_ids' => $userId, // ID пользователей
                'fields' => 'first_name, last_name' // Список опциональных полей https://vk.com/dev/objects/user
            );
         
            if (!$content = @file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params))) {
                $error = error_get_last();
                throw new Exception('HTTP request failed. Error: ' . $error['message']);
            }
         
            $response = json_decode($content);
         
            // Если возникла ошибка
            if (isset($response->error)) {
                throw new Exception (
                    'При отправке запроса к API VK возникла ошибка. Error code: '
                     . $response->error->error_code . '. Error description: ' . $response->error->error_msg
                );
            }

            //манипуляции для вывода данных
            $response = $response->response; 

            $_SESSION['userData'] =& $response;
            $_SESSION['first_name'] =& $response[0]->first_name;
            $_SESSION['last_name'] =& $response[0]->last_name;

            // Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: ?url=check");
        }
    }        
?>