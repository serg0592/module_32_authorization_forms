<?php
    include_once '../config/role_rules.php';
?>

<div class="main_btn">
    <button class="the_btn" <?=$btnStatus?>>Ради этой <?=$btnAddText?> кнопки ТЫ авторизовался!</button>
    <?php
        echo '<script language="javascript">';
        echo <<<END
            const theBtn = document.querySelector('.the_btn');
            theBtn.addEventListener('click', function callAlert() {
                alert('alert message send by PHP using JS');
            });
        END;
        echo '</script>';
    ?>
</div>