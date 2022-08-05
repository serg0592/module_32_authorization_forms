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
        $arBtnStatus = 'inactive';
    };
    if ($canEdit) {
        $arBtnStatus = 'inactive';
    };
    if ($canDelete) {
        $arBtnStatus = 'active';
    };
    if ($canPush) {
        $arBtnStatus = 'active';
    };
?>