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
            $canDelete = false;
            $canPush = false;
            break;
        case 'guest':
            $canView = true;
            $canEdit = false;
            $canDelete = false;
            $canPush = false;
            break;
    };

    //реализация прав пользователей
    if ($canView) {
        $btnStatus = 'disabled';
        $btnAddText = 'неактивной';
    };
    if ($canEdit) {
        $btnStatus = 'disabled';
        $btnAddText = 'неактивной';
    };
    if ($canDelete) {
        $btnStatus = '';
        $btnAddText = '';
    };
    if ($canPush) {
        $btnStatus = '';
        $btnAddText = '';
    };
?>