<?php
    class Controller_Get_VK_Userdata extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Get_VK_Userdata();
        }

        function action_get_VK_userdata() {
            $this->model->get_VK_userdata();
            $this->view->generate('response_view.php', 'template_view.php');
        }
    }
?>