<?php
    class Controller_Request_OAuth extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Request_OAuth();
        }

        function action_request_oauth() {
            $this->model->request_oauth();
        }
    }
?>