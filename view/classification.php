<?php
    if(!isset($_SESSION))
        {
            session_start();
        }
    $_SESSION["status"] = "classification";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <h1><?php echo $classificationName; ?> vehicles</h1>

                <?php

                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
                        echo $message;
                        $message = "";
                    }

                    if(isset($vehicleDisplay)){
                        // var_dump($vehicleDisplay);
                        echo $vehicleDisplay;
                    }
                ?>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </div>
    </body>
</html>