<!DOCTYPE html>

<html lang="en">

<?php   
    if (isset($_GET['action'])) {
        $current_page = $_GET['action'];
        if ($current_page != '500') {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
        }
    }
    ?>
    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body class="body1">
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