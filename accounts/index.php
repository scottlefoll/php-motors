<?php
    // This is the accounts controller
    $action = filter_input(INPUT_POST, 'action');
        if ($action == NULL){
            $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'something':
            break;
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/model/main-model.php';
    }

?>