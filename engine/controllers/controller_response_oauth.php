<?php
    class Controller_Response_OAuth extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Response_OAuth();
        }

        function action_response_oauth() {
            $this->model->responseOAuth();
            $this->view->generate('response.php, template.php');
        }
    }
?>