<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
?> 

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; 
        $_SESSION['Status'] = "add_vehicle";
    ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; 
                echo "<script>alert('Enter add-vehicle.php');</script>";            
            ?> 
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">       

            <!-- PROBLEM: All of this code duplicates the Vehicle controller code, which is not visible to add_vehicle.php -->
            <?php // Get the database connection file
                require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
                // Get the PHP Motors model for use as needed
                require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
                // Get the PHP vehicles model for use as needed
                require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';

                $classifications = getClassifications();
            ?> 

            <!-- Main -->
            <main>

            <!-- create a drop down select for Classification -->
                
                <br>
                <h2>Add Vehicle</h2>
                <br>
                <h4>*Please note: all fields are required.</h4>

                <?php
                        if(array_key_exists('addVehicle', $_POST)) {
                            submitVehicleBtn2();
                        }
                        function submitVehicleBtn2() {
                            echo "<script>alert('!!! Submit Add_vehicle -> go to vehicle controller');</script>";
                            $_SESSION['status'] = "add_vehicle";    
                            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php?action=add_vehicle';
                            exit();
                        }
                ?>

                <!-- <form method="post";> -->
                <form method="post" action= '/phpmotors/vehicle/index.php?action=add_vehicle';>
                    <fieldset>
                        <legend>Vehicle Information</legend>
                        <label class="top" for="invMake">Make* <input type="text" id="invMake" name="invMake" value="" required></label>
                        <label class="top" for="invModel">Model*  <input type="text" id="invModel" name="invModel" value="" required></label>
                        <label class="top" for="invDescription">Description* <input type="invDescription" id="invDescription" name="invDescription" value="" required></label>
                        <label class="top" for="invImage">Image*  <input type="text" id="invImage" name="invImage" value="" required></label>
                        <label class="top" for="invThumbnail">Thumbnail* <input type="text" id="invThumbnail" name="invThumbnail" value="" required></label>
                        <label class="top" for="invPrice">Price*  <input type="text" id="invPrice" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="$25,000.00" data-type="currency" name="invPrice" value="" required></label>
                        <label class="top" for="invStock">In Stock* <input type="number" id="invStock" name="invStock" value="" required></label>
                        <label class="top" for="password">Color*  <input type="text" id="invColor" name="invColor" value="" required></label>
                        <label class="top" for="email">Email* <input type="email" id="email" name="email" value="" required></label>
                        <!-- <label class="top" for="classificationId">Classification*  <input type="number" id="classificationId" name="classificationId" value="" required></label> -->
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
                        <!-- <label class="top" for="email">Email* <input type="email" id="email" name="email" value="" required></label> -->
                        
                    </fieldset>
                    <input type="submit" id="addVehicle" value="Add Vehicle" name="addVehicle" class="submitBtn">
                </form>
            
                <p><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>