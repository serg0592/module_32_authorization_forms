<?php
class Route
{
	public static function start()
	{
		//действия по умолчанию
		$controller_name = 'check';
		$action_name = 'check';

        //проверка наличия имя контроллера в GET
		//$_GET['url'] = 'error';
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
			};
		};

		/*session_start();
		include '../config/token.php';
		$_POST["token"] =& $token;
		$_SESSION["CSRF"] =& $_POST['token'];
		$_POST['submitAuth'] = true;
		$_POST['login'] = 'admin';
		$_POST['password'] = '1';*/
		if (isset($_POST['submitAuth'])) {
			$controller_name = 'auth';
			$action_name = 'auth';
		};

		if (isset($_POST['registration'])) {
			$controller_name = 'registration';
			$action_name = 'registration';
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
	}

	public static function ErrorPage404() {
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 not found');
		header('Location'.$host.'404');
	}
}
?>