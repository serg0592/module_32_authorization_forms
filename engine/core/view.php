<?php
class View {
	
	//метод генерации страницы без авторизации
	function generate($content_view, $template_view)
	{
		include '../engine/views/'.$template_view;	
	}
}
?>