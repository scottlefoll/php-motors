<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    // Check if the firstname cookie exists, get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if ((isset($_SESSION['message']) && (isset($_SESSION['message_delivered']) && ($_SESSION['message_delivered'] == True)))){
        unset($_SESSION['message']);
        $_SESSION['message_delivered'] = False;
    }

    // This is the accounts controller
    // Get the database connection file
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    // Get the accounts model
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
    // Get the functions library
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    // Display the alert box 
    // echo "<script>alert('Accounts Controller');</script>";

    // Get the array of classifications
    $classifications = getClassifications();
    $navList = getNavList($classifications);

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    // echo "<script>alert('Accounts Controller: action = $action');</script>";

    // $action = $_SESSION['status'];
    if ($action == "Update Account") {
        $action = "update_account_view";
    } else if($action == "Update Password" ) {
        $action = "update_password_view";
    }

    // echo "<script>alert('Accounts Controller: action2 = $action');</script>";
    switch ($action){
        case 'update_password_view':
            // Case to display the admin view
            // Display the alert box
            // echo "<script>alert('Account Controller: admin view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-password.php';
            exit;
        case 'update_password':
            # this is the update password
            // echo "<script>alert('Accounts Controlle 1: case = update pssword');</script>";

            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $clientPasswordConfirm = filter_input(INPUT_POST, 'clientPasswordConfirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($clientPassword != $clientPasswordConfirm) {
                $message = "<p>The password and confirmation password did not match. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-password.php';
                exit;
            }

            $clientPassword = checkPassword($clientPassword);

            // Check for missing data
            if (empty($clientPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-password.php';
                exit; 
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $updateOutcome = updatePassword($clientId, $hashedPassword);
            // Check and report the result
            if($updateOutcome == TRUE){
                // Check and report the result
                $_SESSION['message'] = "Your account password has been successfully changed.";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
                exit;
            } else {
                $message = "<p>Sorry, but the password change failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-password.php';
                exit;
            }
        case 'update_account_view':
            // Case to display the admin view
            // Display the alert box
            // echo "<script>alert('Account Controller: admin view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-account.php';
            exit;
        case 'update_account':
            # this is the update account 
            // echo "<script>alert('Accounts Controller: case = update account');</script>";
            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientFirstname = ucwords(trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientLastname = ucwords(trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));

            $clientFirstname = checkName($clientFirstname, 15);
            $clientLastname = checkName($clientLastname, 25);
            $clientEmail = checkEmail($clientEmail);

            # check for existing email address
            if (($_SESSION['clientData']['clientEmail'] != $clientEmail) && isExistingEmail($clientEmail)) {
                $message = '<p>That email is already registered. Try logging in instead.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-account.php';
                exit;
            }

            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-account.php';
                exit;
            }

            // Send the data to the model
            $updateOutcome = updateAccount($clientId, $clientFirstname, $clientLastname, $clientEmail);
            // Check and report the result
            if($updateOutcome == TRUE){
                // Check and report the result
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $clientData = getClientById($clientId);
                array_pop($clientData);
                $_SESSION["clientData"] = $clientData;
                $_SESSION['message'] = "Your account information has been successfully updated, $clientFirstname.";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the account update failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-account.php';
                exit;
            }
        case 'login_view':
            // Case to display the login view
            // Display the alert box 
            // echo "<script>alert('Account Controller: login view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        case 'logout':
            # this is the logout case of the Accounts Controller
            // echo "<script>alert('Accounts Controller: case = logout');</script>";
            $_SESSION['loggedin'] = FALSE;
            $_SESSION['clientData'] = NULL;
            $_SESSION['message'] = "You are now logged out.";
            // session_destroy();
            // header('Location: /phpmotors/accounts/?action=login');
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        case 'login':
            # this is the login page view
            // echo "<script>alert('Accounts Controller: case = login');</script>";
            // Filter and store the data
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if (empty($clientEmail) || empty($checkPassword)) {
                // echo "<script>alert('Accounts Controller: clientEmail = $clientEmail , clientPassword = $clientPassword');</script>";
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit; 
            }

            // Send the data to the model
            // echo "<script>alert('Accounts Controller: loginClient clientEmail = $clientEmail, hashPassword = $hashedPassword ');</script>";
            $clientData = getClient($clientEmail);
            if (empty($clientData)) {
                $message = '<p>Sorry, but that email address is not found. Please try again.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit; 
            } else if (password_verify($clientPassword, $clientData['clientPassword'])) {
                // echo "<script>alert('Accounts Controller: login password verified');</script>";
                # password verified - login successful
                setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['message'] = "Thank you, {$clientData['clientFirstname']}. You are now logged in.";
                array_pop($clientData);
                $_SESSION["clientData"] = $clientData;
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
                exit;
            }  else {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit;
            }

        case 'reg_view':
            // Case to display the register view
            // Display the alert box 
            // echo "<script>alert('Account Controller: register view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        case 'register':
            # this is the register page view
            // echo "<script>alert('Accounts Controller: case = register');</script>";

            // Filter and store the data
            $clientFirstname = ucwords(trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientLastname = ucwords(trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $clientPasswordConfirm = filter_input(INPUT_POST, 'clientPasswordConfirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($clientPassword != $clientPasswordConfirm) {
                $message = "<p>The password and confirmation password did not match. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit;
            }

            $clientFirstname = checkName($clientFirstname, 15);
            $clientLastname = checkName($clientLastname, 25);
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            # check for existing email address
            if (isExistingEmail($clientEmail)) {
                $message = '<p>That email is already registered. Try logging in instead.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit;
            }

            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit; 
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
            // Check and report the result
            if($regOutcome == TRUE){
                // Check and report the result
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
                // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit;
            }
        default:
            // Display the login view by default
            // echo "<script>alert('Accounts Controller: default case');</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
    }
?>