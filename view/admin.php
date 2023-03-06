<?php
    // include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
    if(!isset($_SESSION)) 
        {
            session_start();
        }

    if (!isset($_COOKIE['visits']))
    {
    $_COOKIE['visits'] = 0;
    }
    $visits = $_COOKIE['visits'] + 1;
    setcookie('visits', $visits, time() + 3600 * 24 * 365);

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==TRUE))){
        header('Location: /phpmotors/index.php');
    }
    $_SESSION["status"] = "admin";
    // include 'welcome.html.php';
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">

            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br>
                <div class="admin-box">
                    <h1>Admin Page</h1>
                    <br><br>
                    <h2>
                        <?php
                            if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            }
                        ?></h2>
                    <br>
                    <div class="admin-message">
                        <ul class="review1-ul">
                            <li class="review1-li">First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                            <li class="review1-li">Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                            <li class="review1-li">Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                        </ul>
                    </div>
                    <br>
                    <?php
                        if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 0)){
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/admin_content.php';
                        }
                    ?>
                </div>
                <br><br>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>