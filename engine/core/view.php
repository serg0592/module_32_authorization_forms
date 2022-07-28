<?php
class View {
	
	//метод генерации страницы без авторизации
	function generate($content_view, $template_view) {
		include '../engine/views/'.$template_view;	
	}

	//генерации страницы с авторизованным пользователем
	function generateAuth($content_view, $template_view, $authUserData_view, ) {
		include '../engine/views/'.$template_view;
	}
}
?>