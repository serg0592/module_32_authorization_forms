<?php
    class Model_Msg extends Model {        
        function saveMsg() {
            include_once '../config/logger.php'; //логгер
            
            session_start();
            //передаем текст комментария и id изображения
            $_SESSION['msg'] = $_POST['msgText'];

            //проверяем длину комментария
            if(strlen($_SESSION['msg']) < 1 or strlen($_SESSION['msg']) > 500) {
                $log->error('слишком короткое/длинное сообщенеи');
            } else {
                //сохраняем текущую дату        
                $date = date("F j, Y, G:i");
                //заполняем временный массив
                $tmpArr = [
                    $_SESSION['msg'], 
                    $date,
                ];
                //проверяем наличие message.txt
                if(file_exists('../data/message.txt')) {
                    //очищаем файл
                    file_put_contents('../data/message.txt', '');
                    //открываем message.txt
                    $file = fopen('../data/message.txt', 'r+');
                    //заполняем файл из временного массива
                    foreach ($tmpArr as $tmp) {
                        $string = json_encode($tmp).PHP_EOL;
                        fwrite($file, $string);
                    }
                    fclose($file);
                } else {
                    $log->error('файл не найден');
                };
            };
            //переходим на главную страницу
            header('Location: ?url=check');
        }
    }
?>