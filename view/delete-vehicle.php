

<?php
    if(!isset($_SESSION))
        {
            session_start();
        }

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1))){
        header('Location: /phpmotors/index.php');
    }

    $_SESSION["status"] = "delete_vehicle";
?>

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';?>

    <!-- <body class="body1"> -->
        <div id="content-box">

            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

            <title>
                    <?php
                        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
                            echo "Delete $invInfo[invMake] $invInfo[invModel]";}
                        elseif(isset($invMake) && isset($invModel)) {
                            echo "Delete $invMake $invModel"; }
                    ?> | PHP Motors
            </title>

            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">

            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br>
                <h1>
                    <?php
                        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                        echo "Delete $invInfo[invMake] $invInfo[invModel]";
                        } elseif(isset($invMake) && isset($invModel)) {
	                        echo "Delete $invMake $invModel";
                        }
                    ?>
                </h1>

                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>

                <?php
                    if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    }
                ?>

                <?php
                    $imgFile_str = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/images/no-image.png';
                ?>

                <br>
                <h4>*Confirm Vehicle Deletion. The delete is permanent.</h4>

                <!-- <form method="post";> -->
                <form method="post" action= '/phpmotors/vehicles/index.php' >
                    <fieldset>
                        <legend>Vehicle Information</legend>

                        <label class="top" for="invMake">Make* <input type="text" name="invMake" id="invMake"
                            <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> 
                            readonly></label>
                        <label class="top" for="invModel">Model* <input type="text" name="invModel" id="invModel"
                            <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> 
                            readonly</label>
                        <label class="top" for="invDescription">Description* <input type="invDescription" id="description" name="invDescription"
                            <?php if(isset($invDescription)){echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?> 
                            readonly></label>

                            <br><br>
                    </fieldset>

                    <input type="submit" id="addVehicle" name="submit" value="Delete Vehicle" class="submitBtn">
                    <input type="hidden" name="action" value="delete_vehicle">
                    <input type="hidden" name="invId" value="
                        <?php
                            if(isset($invInfo['invId'])){
                                echo $invInfo['invId'];
                            }
                        ?>">

                </form>

                <p><br></p>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>