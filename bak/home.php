<!DOCTYPE html>

<html lang="en">


    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body class="body1">
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

            <!-- Main -->
            <main>
            <br>
            <?php
                    if(isset($_GET['page'])){
                        $current_page = $_GET['page'];
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $current_page . '_content.php';
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