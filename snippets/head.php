<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color" content="blue">
    <meta name="author" content="Scott LeFoll">
    <?php
        if (isset($_SESSION["status"])){
            $status = $_SESSION["status"];
        } else {
            $status = "";
        }
        switch($status){
            case '500':
                echo "<title>php Motors, Inc.  | 500 Error</title>";
                break;
            case 'add_class':
                echo "<title>php Motors, Inc. | Add Vehicle Classification</title>";
                break;
            case 'admin':
                echo "<title>php Motors, Inc. | Admin</title>";
                break;
            case 'classification':
                echo "<title>$classificationName; ?> vehicles | PHP Motors, Inc.</title>";
                break;
            case 'delete_vehicle':
                echo "<title>";
                if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";}
                elseif(isset($invMake) && isset($invModel)) {
                    echo "Delete $invMake $invModel"; 
                }
                echo "| PHP Motors, Inc.</title>";
                break;
            case 'home':
                echo "<title>php Motors | Home Page</title>";
                break;
            case 'login':
                echo "<title>php Motors | Login</title>";
                break;
            case 'register':
                echo "<title>php Motors | Register</title>";
                break;
            case 'troubleshooting':
                echo "<title>php Motors, Inc. | Troubleshooting</title>";
                break;
            case 'update_account':
                echo "<title>php Motors, Inc.  | Update Account Information</title>";
                break;
            case 'update_password':
                echo "<title>php Motors, Inc. | Update Password</title>";
                break;
            case 'update_vehicle':
                echo "<title>";
                if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
                    echo "Update $invInfo[invMake] $invInfo[invModel]";}
                elseif(isset($invMake) && isset($invModel)) {
                    echo "Update $invMake $invModel"; 
                }
                echo "| PHP Motors, Inc.</title>";
                break;
            case 'vehicle_detail':
                echo "<title>";
                if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
                    echo "View $invInfo[invMake] $invInfo[invModel]";}
                elseif(isset($invMake) && isset($invModel)) {
                    echo "View $invMake $invModel"; 
                }
                echo "| PHP Motors, Inc.</title>";
                break;
            case 'vehicle_management':
                echo "<title>php Motors, Inc. | Update Password</title>";
                break;
            case 'image_admin':
                echo "<title>php Motors, Inc. | Image Management</title>";
                break;
            default:
                echo "<title>php Motors, Inc.</title>";
                break;
        }
    ?>
    <meta name="description" content="PHP Motors is a website that sells cars.">
    <link rel="short_icon" href="favicon.ico">
    <link rel="icon" sizes="72x180" href="/phpmotors/images/logo.png">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href='https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap'>;

