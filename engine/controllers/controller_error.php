<?php
    class Controller_Error extends Controller {
        function __construct() {
            $this->view = new View();
        }

        function action_error() { 
            $this->view->generate('error_view.php', 'template_view.php');
        }
    }
?>