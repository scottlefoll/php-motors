<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

    if (!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1))){
        header('Location: /phpmotors/index.php');
    }

    $_SESSION["status"] = "add_vehicle";
?> 

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';?>
    <title>php Motors | Add Vehicle</title>

    <!-- <body class="body1"> -->
        <div id="content-box">

            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; 
                // echo "<script>alert('Enter add-vehicle.php');</script>";
            ?>
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">

            <nav class="nav"><?php echo $navList; ?></nav> 

            <!-- Main -->
            <main>
                <br>
                <h2>Add Vehicle</h2>
                <br>

                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
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

                        <label class="top" for="invMake">Make* <input type="text" id="title" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> placeholder="" maxlength="30" pattern='^[A-Za-z -,.'0-9]{1,30}$' required></label>
                        <label class="top" for="invModel">Model*  <input type="text" id="title" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> placeholder="" maxlength="30" pattern='^[A-Za-z -,.'0-9]{1,30}$' required></label>
                        <label class="top" for="invDescription">Description* <input type="invDescription" id="description" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> placeholder='' maxlength="255" pattern='^[A-Za-z0-9_ ?!\@#$%&*<>,.";:+=']{1,255}$' required></label>
                        <!-- <label class="top" for="invImage">Image*  <input type="text" id="img_filename" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} else{echo "value='no-image.png'";} ?> placeholder='no-image.png' maxlength="50" pattern='^([0-9a-zA-Z\\.\/:_-]+.(png|PNG|gif|GIF|jp[e]?g|JP[E]?G))$' required></label>
                        <label class="top" for="invThumbnail">Thumbnail* <input type="text" id="img_filename" name="invThumbnail"  <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  else{echo "value='no-image.png'";} ?> maxlength="50" placeholder='no-image.png' pattern='^([0-9a-zA-Z\\.\/:_-]+.(png|PNG|gif|GIF|jp[e]?g|JP[E]?G))$' required></label> -->
                        <label class="top" for="invPrice">Price*  <input type="number" id="integer" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> placeholder='25000' pattern='^\+?[1-9]\d*$' min="250" max='1250000' required></label>
                        <!-- <label class="top" for="invStock">In Stock* <input type="number" id="integer" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> placeholder='' pattern='^[0-9]\d{0,5}$' min='1' max='99' required></label> -->
                        <label class="top" for="invColor">Color*  <input type="text" id="title" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> placeholder='' maxlength="20" pattern='^[A-Za-z0-9_ ]{3,20}$' required></label>

                        <label class="top" for="classificationId">Classification*</label>
                            <select name="classificationId" id="classificationId" <?php if(isset($classificationId) && $classificationId > 0){echo "value='$classificationId'";} else {echo "value=''";} ?> min='1' required>
                            <option class="top" for="classificationId" type="number" id="classificationId" name="classificationId" value="" required>Choose a Classification</option>
                            <?php
                                foreach ($classifications as $classification) {
                                    if (isset($classificationId) && $classificationId == $classification['classificationId']) {
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
                    <input type="submit" id="addVehicle" value="Add Vehicle" name="addVehicle" class="submitBtn">
                    <input type="hidden" name="action" value="add_vehicle" class="hidden">
                </form>

                <p><br></p>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>