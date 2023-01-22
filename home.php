<!DOCTYPE html>
<html lang="en">

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php'; ?>

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body background="checkerboard.jpg">
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

            <!-- Main -->
            <main>

            <?php
                    if(isset($_GET['page'])){
                        $current_page = $_GET['page'];
                        echo "<title>PHP Motors |", $current_page, "</title>";
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $current_page . '_content.php';
                    }else{
                        echo "<title>php Motors | Home</title>";
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/home_content.php';
                    }
            ?>
            
                <p><br><br><br><br><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </>
</html>