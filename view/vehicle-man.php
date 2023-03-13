<?php
    if(!isset($_SESSION))
        { 
            session_start();
        }

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1))){
        header('Location: /phpmotors/index.php');
        exit;
    }

    $_SESSION["status"] = "vehicle_man";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
    <title>php Motors  | Vehicle Management</title>

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
                <br>
                <h1>Vehicle Management</h1>

                <?php

                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
                        echo $message;
                        $message = "";
                    }

                    if (isset($classificationList)) {
                        echo "<br>";
                        echo '<h2>Vehicles By Classification</h2>'; 
                        echo "<br>";
                        echo '<p>Choose a classification to see those vehicles</p>'; 
                        echo "<br>";
                        echo $classificationList;
                        }
                ?>
            <div id="vehicle-table">
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <br><br>
                <table id="inventoryDisplay"></table>
            </div>

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
        <script src= '/phpmotors/js/inventory.js' ></script>
    </body>
</html>
<?php unset($_SESSION['message']); ?>