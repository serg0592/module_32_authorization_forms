<h4>Авторизация</h4>
<form class="auth_form" method="POST" action="">
    <div class="auth_form_text">
        <div class="log_text">Логин</div>
        <div class="pas_text">Пароль</div>
        <div class="checkbox_text">Пароль</div>
    </div>
    <div class="auth_form_fields">
        <input name="login" type="text" required> <br>
        <input name="password" type="password" required> <br>
        <input name="remember" type="checkbox" value="remember">
    </div> <br>
    <?php include '../config/token.php'; ?>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input name="submitLogin" type="submit" value="Войти">
</form>
<p>
    <a class="reg_link" href="?url=regPage">Регистрация</a>
</p>