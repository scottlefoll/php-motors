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
            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
            <br>
            <?php
                    if(isset($_GET['action']) and $_GET['action'] != 'template'){
                        // PROBLEM: I need to reset this action to home, but in the appropriate place, if it is loginClient
                        $current_action = $_GET['action'];
                        if ($current_action = "loginClient") {
                            $current_action = "home";
                        }
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