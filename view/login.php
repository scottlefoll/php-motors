<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

    $_SESSION["status"] = "login";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

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
                <br><br>
                <h1>Account Login</h1>

                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <br>
                <h4>*Please note: all fields are required.</h4>

                <form method="post" action= '/phpmotors/accounts/index.php';>
                    <fieldset>
                        <legend>Login Information</legend>
                        <label class="top" for="email">Email* <input type="email" id="email" name="clientEmail" value="" required></label>
                        <label class="top" for="password">Password*  <input type="password" id="password" name="clientPassword" value="" required></label>
                    </fieldset>
                    <input type="submit" name="login" value="Login" class="submitBtn">
                    <input type="hidden" name="action" value="login"  class="hidden">
                    <!-- PROBLEM: should this Form Action go to the controller or the child page? -->
                    <!-- <div class="signup"><p>No account? <button type="submit" name="action" value="register" onclick="/phpmotors/accounts/index.php" class="signupbtn">Sign Up</button></p></div> -->
                    <div class="signup"><p>No account? <button type="submit" name="action" value="register" class="signupbtn">Sign Up</button></p></div>
                </form>

            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
