<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body background="checkerboard.jpg">
        <div class="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

            <!-- Main -->
            <main>

                <?php
                    if(isset($_GET['page'])){
                        $current_page = $_GET['page'];
                    }else{
                        $current_page = "home";
                    }
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $current_page . '_content.php';
                ?>  

            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </>
</html>