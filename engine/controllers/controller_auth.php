<?php
    class Controller_Auth extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Auth();
        }

        function action_index() {
            $this->view->generate('auth_view.php');
        }
    }
?>