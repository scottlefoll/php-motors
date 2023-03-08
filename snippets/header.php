
<header>
    <!-- Header -->
    <img src="/phpmotors/images/logo.png" alt="PHP Motors logo" class="img-logo">

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE){
            // do something here if the value is TRUE
            if($_SESSION['clientData']['clientLevel'] > 1){
                echo '<a href="/phpmotors/index.php?action=admin_view" class="account-link" >Admin</a>';
            }
            echo '<a href="/phpmotors/accounts/index.php?action=logout" class="account-link" >Logout</a>';
            if(isset($cookieFirstname)) {
                echo "<span class='account-link' >Welcome $cookieFirstname</span>";
            } 
        } else {
            // do something here if the value is FALSE
            echo "<script>alert('Header: logged out');</script>";
            echo '<a href="/phpmotors/accounts/index.php" class="account-link" >Login</a>';      
        }
    ?>
</header>