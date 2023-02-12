<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
?> 

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

    <!-- <body class="body1"> -->
        <div id="content-box">
            <!-- Header -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; 
                // echo "<script>alert('Enter vehicle_man.php');</script>";
            ?> 
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">       

            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br><br>
                <h2>Vehicle Management</h2>
                <br><br>
                <!-- <form method="post";> -->
                
                <?php
                    
                    if(isset($_POST['addClass'])) {
                                echo "<script>alert('vehicle_man.php : action = add_class');</script>";
                                $_POST['action'] = 'add_class';
                                require_once($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php');
                            } else if(isset($_POST['addVehicle'])) {
                                echo "<script>alert('vehicle_man.php : action = add_vehicle');</script>";
                                $_POST['action'] = 'add_vehicle';
                                require_once($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php');
                            }
                ?>


                <form method="post">
                    <input type="submit" id="addClass" name="addClass" value="Add Classification" class="submitBtn">
                    <br>
                    <br>
                    <input type="submit" id="addVehicle" name="addVehicle" value="Add Vehicle" class="submitBtn">
                    <br><br>
                </form>

                <p>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>