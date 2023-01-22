<!DOCTYPE html>
<meta name="title" content="PHP Motors">
<html lang="en">
<meta name="title" content="PHP Motors">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php'; ?>

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <body class="body1">
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
    </body>
</html>