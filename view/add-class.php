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
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            <!-- STYLE SHEETS -->
            <!-- phone-default -->
            <link href="/phpmotors/css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="/phpmotors/css/large-forms.css" rel="stylesheet">       


            <!-- PROBLEM: All of this code duplicates the Vehicle controller code, which is not visible to add_class.php -->
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
                <br>
                <h2>Add Vehicle Classification</h2>
                <br>
                <!-- <form method="post";> -->
                <form method="post" action= '/phpmotors/index.php?action=add-class';>
                    <fieldset>
                        <legend>Classification Information</legend>
                        <label class="top" for="classificationName">Classification Name*  <input type="text" id="classificationName" name="classificationName" value="" required></label>
                    </fieldset>
                    <input type="submit" value="Add Classification" name=addClassification class="submitBtn">
                </form>
            
                <p><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>