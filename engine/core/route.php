<?php
class Route
{
	public static function start()
	{
		//действия по умолчанию
		$controller_name = 'check';
		$action_name = 'check';

        //проверка наличия имя контроллера в GET
		if (isset($_GET['url'])) {
			switch ($_GET['url']) {
				case 'main':
					$controller_name = 'main';
					$action_name = 'index';
					break;
				case 'regPage':
					$controller_name = 'registration';
					$action_name = 'open_reg';
					break;
				case 'regSuccessPage':
					$controller_name = 'registration';
					$action_name = 'reg_success';
					break;
				case 'check':
					$controller_name = 'check';
					$action_name = 'check';
					break;
				case 'error':
					$controller_name = 'error';
					$action_name = 'error';
					break;
				case 'authorized':
					$controller_name = 'main';
					$action_name = 'authorized';
					break;
				case 'logout':
					$controller_name = 'logout';
					$action_name = 'logout';
					break;
				case 'authSuccess':
					$controller_name = 'main';
					$action_name = 'authSuccess';
					break;
				case 'request_oauth':
					$controller_name = 'request_oauth';
					$action_name = 'request_oauth';
					break;
				case 'getVKUserdata':
					$controller_name = 'get_VK_userdata';
					$action_name = 'get_VK_userdata';
					break;
				case 'secretPage':
					$controller_name = 'secret_page';
					$action_name = 'open';
					break;
			};
		};

		//проверка данных формы из index.html (переход к VK OAuth или на страницу авторизации этого приложения)
		if(isset($_GET['sendOAuthCode']) && (!$_GET['code'] == '')) {
				$controller_name = 'response_oauth';
				$action_name = 'response_oauth';
		};

		//нажата кнопка "Авторизоваться"
		if (isset($_POST['submitAuth'])) {
			$controller_name = 'auth';
			$action_name = 'auth';
		};
		
		//нажата кнопка "Зарегистрироваться" на странице регистрации
		if (isset($_POST['registration'])) {
			$controller_name = 'registration';
			$action_name = 'registration';
		};
		
		//отправлено сообщение
		if (isset($_POST['sendMsg'])) {
			$controller_name = 'msg';
			$action_name = 'saveMsg';
		};

		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "../engine/models/".$model_file;
		if(file_exists($model_path))
		{
			include "../engine/models/".$model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php'; //в нижний регистр
		$controller_path = "../engine/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "../engine/controllers/".$controller_file;
		}
		else
		{			
			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			//вызываем страницу с ошибкой 404
		    Route::ErrorPage404();
		};

		/*
		//печать данных для контроля
		session_start();

		//если есть ошибки, то печатаем их (использовалось до подключения логгера)
		if (isset($_SESSION['err'])) {
			var_dump($_SESSION['err']);
		};

		//если есть id пользователя в сессии, то выводим его id, логин, пароль и хэш авторизации
		if(isset($_SESSION['id'])) {
			echo "id(DB)         = " . $_SESSION['id']."<br>";
			echo "log(DB)        = " . $_SESSION['login']."<br>";
			echo "password(DB)   = " . $_SESSION['password']."<br>";
			echo "auth hash(DB)  = " . $_SESSION['authHash']."<br>";

		//или проверяем наличие VK-токена в сессии
		} elseif (isset($_SESSION['VKoauthToken'])) {
			echo "auth token(VK) = " . $_SESSION['VKoauthToken']."<br>";

			//печать ответа VK на запрос авторизации
			if(isset($_SESSION['response'])) {
				var_dump($_SESSION['response']);
			};
			echo "<br>";
			
			//печать запрошенных из VK данных пользователя
			if(isset($_SESSION['userData'])) {
				var_dump($_SESSION['userData']);
			};
		};
		*/
		
	}

	

	public static function ErrorPage404() {
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 not found');
		header('Location'.$host.'404');
	}
}
?>