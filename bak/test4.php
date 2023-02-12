<? 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<?php 
    // db connectivity - load data
    require_once 'accounts/index.php';

    // create nav bar content
    require_once 'snippets/navigation.php';

    require_once 'controllers/index.php';


    require_once 'snippets/head.php'; ?>

<body>
    
    <?php

    // Header, which contains nav div
    require_once 'snippets/header.php'; 

    echo "<main>";
    // Main content loaded from controller
    require_once 'view/' . $main_content . '.php';
    echo "</main>";
    // Footer
    require_once './snippets/footer.php'; 
    ?>

</body>

</html>

<section>


<?php 
  // Check for missing data
  $clientFirstname = filter_input(INPUT_POST,"clientFirstname");
  $clientLastname = filter_input(INPUT_POST,"clientLastname");
  $clientEmail = filter_input(INPUT_POST, "clientEmail");
  $clientPassword = filter_input(INPUT_POST,"clientPassword");

  if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    require_once 'view/account-register-form.php'; 
    } else
    {

      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
      echo $clientFirstname . ' - ' . $clientLastname . ' - ' . $clientEmail . ' - ' . $clientPassword;

      echo $regOutcome;
      // Check and report the result
      if($regOutcome === 1){
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        require_once 'view/account-signin-form.php';
        
      } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        require_once 'view/account-register-form.php';
      }
    }
?>


</section>