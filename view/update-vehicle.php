

<?php
    if(!isset($_SESSION))
        {
            session_start();
        }

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1))){
        header('Location: /phpmotors/index.php');
    }

    $_SESSION["status"] = "update_vehicle";
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
                <br>
                <h1>
                    <?php
                        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                        echo "Modify $invInfo[invMake] $invInfo[invModel]";
                        } elseif(isset($invMake) && isset($invModel)) {
	                        echo "Modify $invMake $invModel";
                        }
                    ?>
                </h1>

                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    } elseif (isset($message)) {
                        echo $message;
                        $message = "";
                    }
                ?>

                <?php
                    $imgFile_str = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/images/no-image.png';
                ?>

                <br>
                <h4>*Please note: all fields are required.</h4>

                <!-- <form method="post";> -->
                <form method="post" action= '/phpmotors/vehicles/index.php' >
                    <fieldset>
                        <legend>Vehicle Information</legend>

                        <label class="top" for="invId">VIN  <input type="text" id="invId" name="invId"
                            <?php if(isset($invId)){echo "value='$invId'";} elseif(isset($invInfo['invId'])) {echo "value='$invInfo[invId]'"; }?> 
                            disabled></label>
                        <label class="top" for="invMake">Make* <input type="text" name="invMake" id="invMake"
                            <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
                            placeholder="" maxlength="30" pattern='^[A-Za-z -,.'0-9]{1,30}$' required></label>
                        <label class="top" for="invModel">Model* <input type="text" name="invModel" id="invModel"
                            <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
                            placeholder="" maxlength="30" pattern='^[A-Za-z -,.'0-9]{1,30}$' required></label>
                        <label class="top" for="invYear">Year* <input type="number" id="invYear" name="invYear"
                            <?php
                                if(isset($invYear)){echo "value='$invYear'";} elseif(isset($invInfo['invYear'])) {echo "value='$invInfo[invYear]'"; }
                            ?>
                            placeholder='' pattern='^[0-9]\d{0,5}$' min='1900' max='2100' required></label>
                        <label class="top" for="invDescription">Description* <input type="text" id="invDescription" name="invDescription"
                            <?php if(isset($invDescription)){echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>
                            placeholder='' maxlength="255" pattern='^[A-Za-z0-9_ ?!\@#$%&*<>,.";:+=']{1,255}$' required></label>
                        <label class="top" for="invPrice">Price*  <input type="number" id="invPrice" name="invPrice"
                            <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>
                            placeholder='5000' pattern='^\+?[1-9]\d*$' min="250" max='1250000' required></label>
                        <label class="top" for="invMiles">Miles* <input type="number" id="invMiles" name="invMiles"
                            <?php
                                if(isset($invMiles)){echo "value='$invMiles'";} elseif(isset($invInfo['invMiles'])) {echo "value='$invInfo[invMiles]'"; }
                            ?>
                            placeholder='' pattern='^[0-9]\d{0,5}$' min='0' max='1000000' required></label>
                        <label class="top" for="invColor">Color*  <input type="text" id="invColor" name="invColor"
                            <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?> 
                            placeholder='' maxlength="20" pattern='^[A-Za-z0-9_ ]{3,20}$' required></label>

                        <label class="top" for="classificationId">Classification*</label>
                            <select name="classificationId" id="classificationId"
                                <?php
                                    if(isset($classificationId) && $classificationId > 0){
                                        echo "value='$classificationId'";
                                    } elseif(isset($invInfo['classificationId'])) {
                                        echo "value='classificationId[invMake]'";
                                    } else {echo "value=''";}
                                ?> min='1' required>

                            <option class="top"
                                    type="number"
                                    id="classificationId"
                                    name="classificationId"
                                    value=""
                                    required>Choose a Classification</option>

                            <?php
                                // Build the classifications option list
                                foreach ($classifications as $classification) {
                                    if (isset($classificationId) && $classificationId === $classification['classificationId']) {
                                        $selected = 'selected';
                                    } elseif (isset($invInfo['classificationId']) && $invInfo['classificationId'] === $classification['classificationId']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo "<option value='$classification[classificationId]' $selected>$classification[classificationName]</option>";
                                }
                            ?>
                            </select>
                            <br><br>
                    </fieldset>

                    <input type="submit" id="addVehicle" name="submit" value="Update Vehicle" class="submitBtn">
                    <input type="hidden" name="action" value="update_vehicle">
                    <input type="hidden" name="invId" value="
                        <?php
                            if(isset($invInfo['invId'])){
                                echo $invInfo['invId'];
                            } elseif(isset($invId)){
                                echo $invId;
                            }
                        ?>
                    ">

                </form>

                <p><br></p>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>