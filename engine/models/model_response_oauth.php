<?php
    class Model_Response_OAuth extends Model {
        public function responseOAuth() {
            //подключим файл модели с параметрами запроса OAuth
            include_once '..engine/models/model_request_oauth';

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
                throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
            }
            //А вот здесь выполняем код, если все прошло хорошо
            $token = $response->access_token; // Токен
            $expiresIn = $response->expires_in; // Время жизни токена
            $userId = $response->user_id; // ID авторизовавшегося пользователя
         
            // Сохраняем токен в сессии
            $_SESSION['oauthToken'] = $token;
            $_SESSION['response'] = $response;
        }
    }        
?>