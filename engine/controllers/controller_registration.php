<?php
class Controller_Registration extends Controller { 
    function __construct() {
        $this->model = new Model_Registration();
        $this->view = new View();
        
    }

    //метод регистрации нового пользователя
    function action_index() { 
        $this->model->userReg();
    }
    
    //метод генерации страницы с формой регистрации
    function action_open_reg() {
        $this->view->generate('registration_view.php', 'template_view.php');
    }

    //страница с сообщением об успешной регистрации
    function action_reg_success() {
        $this->view->generate('registration_success_view.php', 'template_view.php');
    }
}
?>