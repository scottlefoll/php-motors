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
                <h1>Update Account Information</h1>
                <br>
                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                    echo "<br>";
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form method="post" action="/phpmotors/accounts/index.php" >
                    <fieldset>
                        <legend>Update Account Information</legend>
                        <label class="top" for="fname">First Name* <input type="text" id="fname" name="clientFirstname"
                                <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo "value='{$_SESSION['clientData']['clientFirstname']}'"; }?> 
                                maxlength="15" pattern = '^[A-Za-z -,.']{1,15}$'; required>
                        </label>
                        <label class="top" for="lname">Last Name*  <input type="text" id="lname" name="clientLastname" 
                                <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value='{$_SESSION['clientData']['clientLastname']}'"; }?> 
                                maxlength="30" pattern="^[A-Za-z -,.']{1,30}$" required>
                        </label> 
                        <label class="top" for="email">Email*<input type="email" id="email" 
                                <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])) {echo "value='{$_SESSION['clientData']['clientEmail']}'"; }?> 
                                maxlength="40" pattern="^.+@[^\.].*\.[a-z]{2,}$"  name="clientEmail" placeholder="johndoe@gmail.com" required>
                        </label>
                    </fieldset>
                    <input type="submit" name="submit" id="regbtn" value="Update Account"  class="submitBtn">
                    <input type="hidden" name="action" value="update_account"  class="hidden">
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
