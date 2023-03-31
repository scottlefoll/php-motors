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
                                <label class="top-search search-sort" for="invId">Order by:</label>
                                <div id="search-fieldset-radio-div">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvId" value="InvId">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvYear" value="InvYear">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvMake" value="InvMake">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvModel" value="InvModel">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvPrice" value="InvPrice">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvMiles" value="InvMiles">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-InvColor" value="InvColor">
                                    <input class="top-search search-sort" type="radio" name="sort-order" id="search-radio-classificationId" value="classificationId">
                                </div>
                                <div id="search-fieldset-input-div">
                                    <label class="top-search search-param" class="" for="invId">VIN:  <input type="text" id="invId" name="invId" maxlength="20"></label>
                                    <label class="top-search search-param" for="invMaxYear">Min Year:  <input type="number" id="invMinYear" name="invMinYear" maxlength="4"></label>
                                    <label class="top-search search-param" for="invMaxYear">Max Year:  <input type="number" id="invMaxYear" name="invMaxYear" maxlength="4"></label>
                                    <label class="top-search search-param" for="invMake">Make:  <input type="text" id="invMake" name="invMake" maxlength="30"></label>
                                    <label class="top-search search-param" for="invModel">Model:  <input type="text" id="invModel" name="invModel" maxlength="50"></label>
                                    <label class="top-search search-param" for="invDesc">Partial Description:  <input type="text" id="invDesc" name="invDesc" maxlength="255"></label>
                                    <label class="top-search search-param" for="invMinPrice">Min Price:  <input type="number" id="invMinPrice" name="invMinPrice" step="0.01" maxlength="15"></label>
                                    <label class="top-search search-param" for="invMaxPrice">Max Price:  <input type="number" id="invMaxPrice" name="invMaxPrice" step="0.01" maxlength="15"></label>
                                    <label class="top-search search-param" for="invMiles">Max Miles:  <input type="text" id="invMiles" name="invMiles" maxlength="30"></label>
                                    <label class="top-search search-param" for="invColor">Color:  <input type="text" id="invColor" name="invColor" maxlength="30"></label>
                                    <label class="top-search search-param" for="classificationId">Classification*</label>
                                    <select class="top-search search-param" name="classificationId" id="search-classificationId"
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
                                </div>
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
                        <?php if (isset($_SESSION["vehicles"])) {$vehicles = $_SESSION["vehicles"];} ?>
                        <!-- <div id="search-table-div"> -->
                            <table id="search-table">
                                <thead>
                                    <tr>
                                    <th style="width: 15%;">VIN</th>
                                    <th style="width: 5%;">Year</th>
                                    <th style="width: 15%;">Make</th>
                                    <th style="width: 15%;">Model</th>
                                    <th style="width: 10%;">Price</th>
                                    <th style="width: 7%;">Miles</th>
                                    <th style="width: 10%;">Color</th>
                                    <th style="width: 10%;">Image</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($vehicles as $vehicle): ?>
                                    <tr style="height:30px">
                                        <td style="width: 15%;"><?php echo substr($vehicle['invId'], 0, 20); ?></td>
                                        <td style="width: 5%;"><?php echo $vehicle['invYear']; ?></td>
                                        <td style="width: 15%;"><?php echo $vehicle['invMake']; ?></td>
                                        <td style="width: 15%;"><?php echo $vehicle['invModel']; ?></td>
                                        <td style="width: 10%;"><?php echo "$" . number_format($vehicle['invPrice']); ?></td>
                                        <td style="width: 7%;"><?php echo number_format($vehicle['invMiles']); ?></td>
                                        <td style="width: 10%;"><?php echo $vehicle['invColor']; ?></td>
                                        <td>
                                            <!-- <a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'> -->
                                            <img src="<?php echo $vehicle['imgPath']; ?>" alt="<?php echo $vehicle['imgName']; ?>" class"search-image" width="50" height="40">
                                            <!-- </a>"; -->
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <!-- </div> -->
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
