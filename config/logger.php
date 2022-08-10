<?php
    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    // Создаем логгер 
    $log = new \Monolog\Logger('firstLogger');

    // Хендлер, который будет писать логи в "log.txt" и слушать все ошибки с уровнем "DEBUG" и выше .
    $log->pushHandler(new Monolog\Handler\StreamHandler('../data/logs/mylog.log', Logger::DEBUG));
?>