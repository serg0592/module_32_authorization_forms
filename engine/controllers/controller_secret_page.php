<?php
    class Controller_Secret_Page extends controller {
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Secret_Page();
        }

        function action_open() {
            $this->view->generate('secret_page_view.php', 'template_view.php');
        }
    }
?>