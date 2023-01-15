<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body background="checkerboard.jpg">
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

            <!-- Main -->
            <main>
                <?php
                    $current_page = basename($_SERVER['PHP_SELF'], '.php');
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/home_content.php'; 
                ?>    

                <p><br><br><br><br><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </>
</html>


    