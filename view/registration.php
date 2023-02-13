<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
    
    $_SESSION["status"] = "register";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';?>

    <body class="body1">
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">       

            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br>
                <h1>PHP Motors Account Registration</h1>
                <br>
                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form method="post" action="/phpmotors/accounts/index.php" >
                    <fieldset>
                        <legend>Account Information</legend>
                        <label class="top" for="fname">First Name* <input type="text" id="fname" name="clientFirstname" value="" required></label>
                        <label class="top" for="lname">Last Name*  <input type="text" id="lname" name="clientLastname" value="" required></label>
                        <label class="top" for="password">Password* <input type="password" id="password" name="clientPassword" value="" required></label>
                        <label class="top" for="email">Email *<input type="email" id="email" name="clientEmail" placeholder="someone@gmail.com" required></label>
                    </fieldset>
                    <input type="submit" name="submit" id="regbtn" value="Register"  class="submitBtn">
                    <input type="hidden" name="action" value="register"  class="hidden">
                </form>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
