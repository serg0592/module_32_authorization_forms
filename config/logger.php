<?php
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Formatter\HtmlFormatter;

    // Создаем логгер 
    $log = new Logger('firstLogger');

    // Хендлер, который будет писать логи в "log.txt" и слушать все ошибки с уровнем "NOTICE" и выше .
    $log->pushHandler(new StreamHandler('../data/logs/mylog.log', Logger::NOTICE));
?>