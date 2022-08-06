<?php
    include_once '../config/role_rules.php';
?>

<div class="main_btn">
    <button class="the_btn" <?=$btnStatus?>>Ради этой кнопки ТЫ авторизовался!</button>
    <?php
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
    ?>
</div>