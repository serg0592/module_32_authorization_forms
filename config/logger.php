<?php
    require '../vendor/autoload.php';

    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    // Создаем логгер 
    $log = new Logger('firstLogger');

    // Хендлер, который будет писать логи в "log.txt" и слушать все ошибки с уровнем "DEBUG" и выше .
    $log->pushHandler(new StreamHandler('../data/logs/log.txt', Logger::DEBUG));
?>