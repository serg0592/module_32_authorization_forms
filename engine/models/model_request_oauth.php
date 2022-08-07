<?php
    class Model_Request_OAuth extends Model {
        public function requestOAuth() {
            session_start(); // Токен храним в сессии
 
            // Параметры приложения
            $clientId     = '51396063'; // ID приложения
            $clientSecret = 'QjyZaRAexj5w4gowqqkm'; // Защищённый ключ
            $redirectUri  = 'https://serg0592.github.io/module_32_authorization_forms/index.html'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
            $display = 'popup';
        
            // Формируем ссылку для авторизации
            $params = array(
                'client_id'     => $clientId,
                'display'       => $display,
                'redirect_uri'  => $redirectUri,
                'scope'         => 'photos',
                'response_type' => 'code',
                'v'             => '5.131', // (обязательный параметр) версиb API https://vk.com/dev/versions
            
                // Права доступа приложения https://vk.com/dev/permissions
                // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
                // Если не указать "offline", то полученный токен будет жить 12 часов.
            );
            //переходим по ссылке
            header("Location: http://oauth.vk.com/authorize?" . http_build_query($params));
        }
    }        
?>