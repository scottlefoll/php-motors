<!DOCTYPE html>

<html lang="en">


<?php   
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
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
            <img src="/phpmotors/images/logo.png" alt="PHP Motors logo" class="img-logo">
            <!-- <a href='' class="account-link" style="text-align:right;float:right;padding-right:50px;padding-top:25px;";>My Account</a> -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?>

            <!-- Main -->
            <main>
            <br>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/500_content.php'; ?>
            
                <p><br><br><br><br><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>body>
</html>