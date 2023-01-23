$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'something':
        break;
    default:
        <!-- include '/phpmotors/view/home.php'; -->
        include '/phpmotors/template.php';
}
