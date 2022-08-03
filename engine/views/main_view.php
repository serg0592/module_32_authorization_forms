<h4>Авторизация</h4>
<form class="auth_form" method="POST" action="">
    <div class="auth_form_text">
        <div class="log_text">Логин</div>
        <div class="pas_text">Пароль</div>
        <div class="checkbox_shell">
            <input name="rememberUser" type="checkbox" value="remember">
        </div>
    </div>
    <div class="auth_form_fields">
        <input name="login" type="text" required> <br>
        <input name="password" type="password" required> <br>
        <div class="checkbox_text">Запомнить меня</div>
    </div> <br>
    <?php include '../config/token.php'; ?>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input name="submitAuth" type="submit" value="Авторизоваться">
</form>
<p>
    <a class="reg_link" href="?url=regPage">Регистрация</a>
</p><br>
<p>
    <a class="reg_linkVK" href="?url=request_oauth">
        Авторизация через ВКонтакте</a>
</p>