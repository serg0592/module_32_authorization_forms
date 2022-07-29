<?php
    class Controller_Main extends Controller {
        function __construct() {
            $this->model = new Model_Main();
            $this->view = new View();
        }

        function action_index() {
            $this->view->generate('main_view.php', 'template_view.php');
        }

        function action_authorized() {
            $this->view->generateAuth('empty_content_view.php', 'template_view.php', 'auth_user_greating_view.php');
        }

        function action_authSuccess() {
            $this->view->generate('auth_success_view.php', 'template_view.php');
        }
    }
?>