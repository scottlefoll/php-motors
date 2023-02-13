<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?>
            
            <!-- Main -->
            <main>
            <br>
            <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/500_content.php';
            ?>
            
                <p><br><br><br><br><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
