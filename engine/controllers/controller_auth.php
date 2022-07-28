<?php
    class Controller_Auth extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Auth();
        }

        function action_auth() {
            $this->model->userAuth();
            $this->view->generate('auth_success_view.php', 'template_view.php');
        }
    }
?>