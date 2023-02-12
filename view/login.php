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
                <h1>PHO Motors Login</h1>
                <br>

                <?php
                    // if ($_SESSION["login"] = "true")
                    // {
                    //     $message = "<p>You are currently logged in as {$_SESSION['email']}.</p>";
                    // }
                ?>

                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>

                <?php
                        // if(array_key_exists('addVehicle', $_POST)) {
                        //     submitVehicleBtn2();
                        // }
                        // function submitVehicleBtn2() {
                        //     echo "<script>alert('!!! Submit Add_vehicle -> go to vehicle controller');</script>";
                        //     $_SESSION['status'] = "add_vehicle";    
                        //     include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php?action=add_vehicle';
                        //     exit();
                        // }
                ?>

                <!-- <form method="post";> -->
                <form method="post" action= '/phpmotors/accounts/index.php';>
                    <fieldset>
                        <legend>Login Information</legend>
                        <label class="top" for="email">Email* <input type="email" id="email" name="clientEmail" value="" required></label>
                        <label class="top" for="password">Password*  <input type="password" id="password" name="clientPassword" value="" required></label>
                    </fieldset>
                    <input type="submit" name="login" value="Login" class="submitBtn">
                    <input type="hidden" name="action" value="login"  class="hidden">

                    <div class="signup"><p>No account? <button type="submit" name="action" value="register" onclick="/phpmotors/accounts/index.php" class="signupbtn">Sign Up</button></p></div>
                                        
                </form>

            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
