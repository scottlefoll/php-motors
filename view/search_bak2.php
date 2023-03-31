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

                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    if (isset($message)) {
                        echo $message;
                        $message = "";
                    }
                    $search = "";
                    $srNum = "";
                    $searchDisplay = "";
                    $paginationBar = "";
                ?>
                <div id="search-container-div">
                    <div id="search-form-div">
                        <form action="/phpmotors/search" method="get" class="search results">
                        <!-- <form method="post" action= '/phpmotors/vehicles/index.php' > -->
                            <fieldset id="search-fieldset">
                                <legend>Enter Any or All Search Criteria</legend>
                                <label class="top" for="invId">VIN:  <input type="text" id="invId" name="invId" maxlength="20"></label>
                                <label class="top" for="invMaxYear">Min Year:  <input type="number" id="invMinYear" name="invMinYear" maxlength="4"></label>
                                <label class="top" for="invMaxYear">Max Year:  <input type="number" id="invMaxYear" name="invMaxYear" maxlength="4"></label>
                                <label class="top" for="invMake">Make:  <input type="text" id="invMake" name="invMake" maxlength="30"></label>
                                <label class="top" for="invModel">Model:  <input type="text" id="invModel" name="invModel" maxlength="50"></label>
                                <label class="top" for="invDesc">Partial Description:  <input type="text" id="invDesc" name="invDesc" maxlength="255"></label>
                                <label class="top" for="invMinPrice">Min Price:  <input type="number" id="invMinPrice" name="invMinPrice" step="0.01" maxlength="15"></label>
                                <label class="top" for="invMaxPrice">Max Price:  <input type="number" id="invMaxPrice" name="invMaxPrice" step="0.01" maxlength="15"></label>
                                <label class="top" for="invMiles">Max Miles:  <input type="text" id="invMiles" name="invMiles" maxlength="30"></label>
                                <label class="top" for="invColor">Color:  <input type="text" id="invColor" name="invColor" maxlength="30"></label>

                                <label class="top" for="classificationId">Classification*</label>
                                <select name="classificationId" id="search-classificationId"
                                    <?php
                                        if(isset($classificationId) && $classificationId > 0){
                                            echo "value='$classificationId'";}
                                        else {
                                            echo "value=''";}
                                    ?>>

                                <option class="top"
                                        for="classificationId"
                                        type="number"
                                        id="classificationId"
                                        name="classificationId"
                                        value=""
                                        required>Choose a Classification</option>

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

                            <input type="submit" name="pswdBtn" value="Search" class="submitBtn">
                            <input type="hidden" name="action" value="search" class="hidden">
                            <br><br>
                            <?php if ($search != "") {echo "<label>You searched for: </label> value='$search'";} ?>
                            <br>
                        </form>
                    </div>
                    <br>
                    <div id="search-results-div">
                        <h1 id="vehicle-search-title">Vehicle Search Results</h1>
                        <!-- <h1>
                        <?php 
                            // if (isset($search)) {
                            //     echo "Returned $srNum results for: $search";}
                        ?></h1> -->

                        <?php
                        if (isset($searchDisplay)) {
                            echo $searchDisplay;
                        }

                        if (isset($paginationBar)) {
                            echo $paginationBar;
                        }
                        ?>
                    </div>
                    <p><br><br><br></p>
                </div>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
