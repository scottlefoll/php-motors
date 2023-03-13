<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
    $_SESSION["status"] = "update_password";
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
                <h1>Update Password</h1>
                <br>
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

                <form method="post" action="/phpmotors/accounts/index.php" >
                    <fieldset>
                        <legend>Change Password</legend>
                        <label class="top" for="password">New Password* <br><br>
                        <span>(Passwords must be at least 8 characters and contain at least <br> 1 number,  1 capital letter and 1 special character)</span>
                        <input type="password" id="password" name="clientPassword" value="" maxlength="255" pattern="^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required></label>
                        <label class="top" for="password">Confirm New Password* <br><br>
                        <input type="password" id="password" name="clientPasswordConfirm" value="" maxlength="255" pattern="^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required></label>
                    </fieldset>
                    <input type="submit" name="submit" id="regbtn" value="Update Password"  class="submitBtn">
                    <input type="hidden" name="action" value="update_password"  class="hidden">
                    <input type="hidden" name="clientId" value="
                        <?php
                            if(isset($_SESSION['clientData']['clientId'])){
                                echo "{$_SESSION['clientData']['clientId']};";
                            } elseif(isset($clientId)){
                                echo $clientId;
                            }
                        ?>
                    ">
                </form>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
