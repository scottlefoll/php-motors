<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    if(!isset($_SESSION)) 
        {
            session_start();
        }

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1))){
        header('Location: /phpmotors/index.php');
    }

    $_SESSION["status"] = "image_admin";
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
                    <h1>Image Management</h1>
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        } else if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <br>
                    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                        <label for="invItem">Vehicle</label>
                            <?php echo $prodSelect; ?>
                            <fieldset>
                                <label>Is this the main image for the vehicle?</label>
                                <label for="priYes" class="pImage">Yes</label>
                                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                                <label for="priNo" class="pImage">No</label>
                                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                            </fieldset>
                        <label>Upload Image:</label>
                        <input type="file" name="file1">
                        <input type="submit" class="regbtn" value="Upload">
                        <input type="hidden" name="action" value="upload">
                    </form>
                    <br>
                    <hr>
                    <h2>Existing Images</h2>
                    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                    <?php
                    if (isset($imageDisplay)) {
                        echo $imageDisplay;
                    } ?>
                </div>
                <br><br>
            </main>
            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
<?php
                        if (isset($_SESSION['message'])) {
                            unset($_SESSION['message']);
                            $message = "";
                        }
?>
