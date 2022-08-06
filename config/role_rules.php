<?php
    //присвоение прав пользователей
    switch ($_SESSION['role']) {
        case 'Administrator':
            $canView = true;
            $canEdit = true;
            $canDelete = true;
            $canPush = true;
            break;
        case 'User':
            $canView = true;
            $canEdit = true;
            break;
        case 'guest':
            $canView = true;
            break;
    };

    //реализация прав пользователей
    if ($canView) {
        $btnStatus = 'disabled';
    };
    if ($canEdit) {
        $btnStatus = 'disabled';
    };
    if ($canDelete) {
        $btnStatus = '';
    };
    if ($canPush) {
        $btnStatus = '';
    };
?>