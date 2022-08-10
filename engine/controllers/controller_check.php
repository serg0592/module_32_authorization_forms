<?php
class Controller_Check extends Controller { 
    function __construct() {
        $this->model = new Model_Check();
        $this->view = new View();        
    }

    function action_check() {
        $this->model->checkUser();
    }
}
?>