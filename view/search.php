<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    if(!isset($_SESSION)) 
        {
            session_start();
        }

    $_SESSION["status"] = "search";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';?>

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
                <form action="/phpmotors/search" method="get" class="search results">
                    <fieldset>
                        <label for="search" class="hidden">What are you looking for today?:</label><br><br>
                        <input type="text" name="search" id="search" <?php if (isset($search)) {
                            echo "value='$search'";
                        } ?>>
                        <input type="hidden" name="action" value="search">
                        <button type="submit" id="pswdBtn">Search</button>
                    </fieldset>
                </form>

                <h1><?php if (isset($search)) {
                    echo "Returned $srNum results for: $search";
                } ?></h1>
                <?php
                if (isset($searchDisplay)) {
                    echo $searchDisplay;
                }

                if (isset($paginationBar)) {
                    echo $paginationBar;
                }
                ?>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
