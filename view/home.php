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
            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
            <br>
            <?php
                    if(isset($_GET['action'])){
                        $current_action = $_GET['action'];
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $current_action . '_content.php';
                    }else{
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/home_content.php';
                    }
            ?>
            
                <p><br><br><br><br><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>