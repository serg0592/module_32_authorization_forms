<?php
    include_once '../config/role_rules.php';
?>

<div class="diff_user_text">
    <p>
        Это текст! Его видят все авторизованные пользователи! 
        Ведь только авторизованные пользователи могут попасть на эту страницу
    </p>
</div>
<div class="diff_user_pic" style="visibility: <?=$viewPic?>">
    <img src="../public/img/example_img1.jpg" alt="example img" style="height: 300px; width: 300px;">
</div>