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

    <!-- <body class="body1"> -->
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
                <h1>Account Login</h1>
                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
                        echo $message;
                        $message = "";
                    }
                ?>
                <br><br>
                <h4>*Please note: all fields are required.</h4>

                <form method="post" action= '/phpmotors/accounts/' >
                    <fieldset>
                        <legend>Login Information</legend>                                                                                                                      
                        <label class="top" for="email">Email* <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>  maxlength="40" pattern="^.+@[^\.].*\.[a-z]{2,}$"  required></label>
                        <label class="top" for="password">Password*  
                        <span>(Passwords must be at least 8 characters and contain at least <br> 1 number,  1 capital letter and 1 special character)</span>
                        <input type="password" id="password" name="clientPassword" value="" maxlength="255" pattern="^(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
                    </fieldset>
                    <input type="submit" name="login" value="Login" class="submitBtn">
                    <input type="hidden" name="action" value="login"  class="hidden">
                    <div class="signup"><p>No account? <button type="button" name="action" value="register"  onClick="myFunction()"  class="signupbtn">Sign Up</button></p></div>
                </form>

            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
        <script>
            function myFunction() {
                window.location.href="/phpmotors/accounts/index.php?action=register";  
            }
        </script>
    </body>
</html>
