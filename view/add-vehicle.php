<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

    $_SESSION["status"] = "add_vehicle";
?> 

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';?>

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
                    if (isset($message)) {
                    echo $message;
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
                        <label class="top" for="invMake">Make* <input type="text" id="invMake" name="invMake" value="" required></label>
                        <label class="top" for="invModel">Model*  <input type="text" id="invModel" name="invModel" value="" required></label>
                        <label class="top" for="invDescription">Description* <input type="invDescription" id="invDescription" name="invDescription" value="" required></label>
                        <label class="top" for="invImage">Image*  <input type="text" id="invImage" name="invImage" value="<?php echo $imgFile_str; ?>" required></label>
                        <label class="top" for="invThumbnail">Thumbnail* <input type="text" id="invThumbnail" name="invThumbnail" value="<?php echo $imgFile_str; ?>" required></label>
                        <label class="top" for="invPrice">Price*  <input type="number" id="invPrice" placeholder="25000" name="invPrice" value="" required></label>
                        <label class="top" for="invStock">In Stock* <input type="number" id="invStock" name="invStock" value="" required></label>
                        <label class="top" for="password">Color*  <input type="text" id="invColor" name="invColor" value="" required></label>
                        <label class="top" for="email">Email* <input type="email" id="email" name="email" value="" required></label>
                        <label class="top" for="classificationId">Classification*</label>
                            <select name="classificationId" id="classificationId" required>
                            <option class="top" for="classificationId" type="number" id="classificationId" name="classificationId" value="0" required>Choose a Classification</option>                            
                            <?php
                                foreach ($classifications as $classification) {
                                    echo "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
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