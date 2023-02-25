<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

    if(isset($_SESSION['clientData']['clientFirstname'])) {
        if($_SESSION['clientData']['clientLevel'] < 2){
            header('Location: /phpmotors/index.php');
        }   
    } 

    $_SESSION["status"] = "vehicle_man";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';?>
            
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">       

            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br><br>
                <?php
                    if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    }
                ?>
                <br>
                <h2>Vehicle Management</h2>

                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>

                <form method="post" action='/phpmotors/vehicles/index.php' >
                    <fieldset>
                        <legend>Vehicle Managemenent Information</legend>
                        <br><br>
                        <input type="submit" name="action" value="Add Vehicle" class="submitBtn">
                        <br><br><br>
                        <input type="submit" name="action" value="Add Classification" class="submitBtn">
                        <br><br><br>
                    </fieldset>
                </form>

            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>