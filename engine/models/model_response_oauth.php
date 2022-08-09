<?php
    class Model_Response_OAuth extends Model {
        public function response_oauth() {
            session_start();
            //подключим файл модели с параметрами запроса OAuth
            include_once '../config/vk_oauth_app_params.php';

            $params = array(
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'code'          => $_GET['code'],
                'redirect_uri'  => $redirectUri,
                'display'       => $display,
            );
         
            if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
                $error = error_get_last();
                throw new Exception('HTTP request failed. Error: ' . $error['message']);
            }
         
            $response = json_decode($content);
         
            // Если при получении токена произошла ошибка
            if (isset($response->error)) {
                throw new Exception('При получении токена произошла ошибка. Error code: ' . $response->error->error_code . '. Error description: ' . $response->error->error_msg);
            }

            //А вот здесь выполняем код, если все прошло хорошо
            $token = $response->access_token; // Токен
            $expiresIn = $response->expires_in; // Время жизни токена
            $userId = $response->user_id; // ID авторизовавшегося пользователя
         
            // Сохраняем токен в сессии
            $_SESSION['VKoauthToken'] = $token;
            $_SESSION['VKuserId'] = $userId;
            $_SESSION['response'] = $response;
        }
    }        
?>