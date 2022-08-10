<?php
    class Controller_Msg extends Controller {
        function __construct() {
            $this->model = new Model_Msg();
            $this->view = new View();
        }

        function action_saveMsg() {
            $this->model->saveMsg();
        }
    }
?>