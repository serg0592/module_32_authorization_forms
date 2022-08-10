<?php
    include_once '../engine/core/controller.php'; //базовый контроллер
    include_once '../engine/core/model.php'; //базовая модель
    include_once '../engine/core/view.php'; //базовый вид
    include_once '../engine/core/route.php'; //маршрутизатор
    include_once '../config/logger.php'; //логгер

    Route::start();
?>