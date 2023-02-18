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
                        <label class="top" for="fname">First Name* <input type="text" id="fname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> pattern = '^[A-Za-z -,.']{1,15}$'; required></label>
                        <label class="top" for="lname">Last Name*  <input type="text" id="lname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> pattern="^[A-Za-z -,.']{1,30}$" required></label> 
                        <label class="top" for="password">Password* <br><br>
                        <span>(Passwords must be at least 8 characters and contain at least <br> 1 number,  1 capital letter and 1 special character)</span>
                        <input type="password" id="password" name="clientPassword" value="" pattern="^(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>                                                        
                        <label class="top" for="email">Email *<input type="email" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> pattern="^.+@[^\.].*\.[a-z]{2,}$"  name="clientEmail" placeholder="johndoe@gmail.com" required></label>
                        
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
