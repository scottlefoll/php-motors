<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

        $_SESSION["status"] = "add_class";
?> 

<!DOCTYPE html>

<html lang="en">

    <!-- Head -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; 
        $_SESSION['Status'] = "add_class";
    ?>

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
                <h2>Add Vehicle Classification</h2>
                <br>
                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form method="post" action= '/phpmotors/vehicles/index.php' >
                    <fieldset>
                        <legend>Classification Information</legend>
                        <label class="top" for="classificationName">Classification Name*  <input type="text" id="classificationName" name="classificationName" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?> pattern="^[A-Za-z -]{1,30}$" required></label>
                        <br>
                    </fieldset>
                    <input type="submit" name=addClassification value="Add Classification" class="submitBtn">
                    <input type="hidden" name="action" value="add_class" class="hidden">
                </form>
            
                <p><br><br><br></p>
            </main> 

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>