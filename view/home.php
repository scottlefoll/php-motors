<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
    $_SESSION["status"] = "home";
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
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        if (isset($message)) {
                            echo $message;
                            $message = "";
                        }
                    ?>
                <br>
                <?php
                        if(isset($_GET['action']) and $_GET['action'] != 'template'){
                            $current_action = $_GET['action'];
                            // echo "<script>alert('home.php: action = $action ');</script>";
                            $content_name = str_replace(' ', '_', $current_action);
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $content_name . '_content.php';
                        }else{
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/home_content.php';
                        }
                ?>

                    <p><br><br><br><br><br><br><br></p>
                </main>
            </div>
            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </body>
</html>