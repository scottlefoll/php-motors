<?php
    if(!isset($_SESSION)) 
        { 
            session_start();
        }
    $_SESSION["status"] = "vehicle_detail";
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


            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">

            <!-- Main -->
            <main>

                <h1 id="vehicle-detail-title">
                    <?php
                        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                        echo "Viewing $invInfo[invMake] $invInfo[invModel]";
                        } elseif(isset($invMake) && isset($invModel)) {
	                        echo "Viewing $invMake $invModel";
                        }
                    ?>
                </h1>

                <?php

                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
                        echo $message;
                        $message = "";
                    }
                    echo "<br>";
                ?>

                    <form >
                        <?php
                            echo $_SESSION['invItemDisplay'];
                        ?>
                    </form>
                <!-- </div> -->
            </main>
            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src= '/phpmotors/js/detail.js' ></script>
    </body>
</html>