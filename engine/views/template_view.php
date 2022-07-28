<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="../public/css/style.css">
        <title>32_Practice</title>
    </head>
    <body>
        <header class="header">
            <div class="auth_shell">
                <?php
                    //если есть авторизованный пользователь, то подгружаем страницу для него,
                    //иначе главную страницу
                    if (isset($authUserData_view)) {
                        include $authUserData_view;
                    } elseif ($content_view == 'main_view.php') {
                        include $content_view;
                    }
                ?>
            </div>
        </header>
        <main class="main">
            <?php
                //подгружаем содержимое страницы
                if ($content_view !== 'main_view.php') {
                    include $content_view;
                }
            ?>
        </main>
        <footer>
        </footer>
    </body>
</html>