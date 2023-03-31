<?php
    if(!isset($_SESSION)) 
    {
        session_start();
    }

    /*************************
     * Search Controller
     * Final Project End Code
     ************************/

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the main model for use as needed
    require_once '../model/main-model.php';
    require_once '../model/search-model.php';
    require_once '../model/vehicles-model.php';
    require_once '../library/functions.php';

    // Get the array of classifications
    $classifications = getClassifications();
    $navList = getNavList($classifications);

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == null) {
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    }

    // echo "<script>alert('Search Controller: action = $action');</script>";

    switch ($action) {
        case 'search':
        // echo "<script>alert('Search Controller: search case')</script>";
        // This allows me to use a form with method="post" as well as pull the query from the pagination links
        $search = array();
        $search['invId'] = trim(filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING));
        $search['invMinYear'] = trim(filter_input(INPUT_GET, 'invMinYear', FILTER_SANITIZE_NUMBER_INT));
        $search['invMaxYear'] = trim(filter_input(INPUT_GET, 'invMaxYear', FILTER_SANITIZE_NUMBER_INT));
        $search['invMake'] = trim(filter_input(INPUT_GET, 'invMake', FILTER_SANITIZE_STRING));
        $search['invModel'] = trim(filter_input(INPUT_GET, 'invModel', FILTER_SANITIZE_STRING));
        $search['invDesc'] = trim(filter_input(INPUT_GET, 'invDesc', FILTER_SANITIZE_STRING));
        $search['invMinPrice'] = trim(filter_input(INPUT_GET, 'invMinPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $search['invMaxPrice'] = trim(filter_input(INPUT_GET, 'invMaxPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $search['invMiles'] = trim(filter_input(INPUT_GET, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
        $search['invColor'] = trim(filter_input(INPUT_GET, 'invColor', FILTER_SANITIZE_STRING));
        $search['classificationId'] = trim(filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $sort = trim(filter_input(INPUT_GET, 'sort-order'));

        // Remove empty elements from $search_arr
        $search = array_filter($search, function($value) {
            return $value !== '';
        });

        if ($sort != ""){ $search['sort'] = $sort;}

        if (empty($search)) {
            $message = '<p class="notice">You must provide a search string.</p>';
            include '../view/search.php';
            exit;
        }
        // page is always pulled from the pagination links, so no need to look at the INPUT_POST
        // $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        // if (empty($page)) {
        //     $page = 1;
        // }
        // echo "<script>alert('Search Controller: search case: ready to sending search string to model')</script>";
        // print("<script>alert('Vehicles Controller: classification, Vehicles = " . print_r($search, true) . "');</script>");
        // print("<script>alert('Vehicles Controller: classification, Vehicles = " . json_encode($search) . "');</script>");
        // print("<script>alert('Vehicles Controller: classification, Vehicles = " . var_export($search, true) . "');</script>");
        // print("<script>alert('Vehicles Controller: classification, Vehicles = " . var_dump($search) . "');</script>");
        // print("<script>alert('Vehicles Controller: classification, Vehicles = " . implode(", ", $search) . "');</script>");
        // echo '<pre>';
        // var_dump($search);
        // echo '</pre>';
        echo "<pre>";
            print_r($search);
        echo "</pre>";
        //     echo "<script>alert('" . json_encode($Search) . "');</script>";
        $sResults = getSearchResults($search);

        // echo '<pre>';
        //     var_dump($sResults);
        // echo '</pre>';
        // echo "<pre>";
        //     print_r($sResults);
        // echo "</pre>";
        //     echo "<script>alert('" . json_encode($sResults) . "');</script>";
        // echo '<div></div>';

        $srNum = 0;
        $srNum = count($sResults);
        $searchDisplay = '<h3 class="notice">Sorry, no results were found to match.</h3>';

        // if ($srNum < 1) {
        //     $searchDisplay = '<h3 class="notice">Sorry, no results were found to match ' . $search . '.</h3>';
        // } elseif ($srNum > 10) {
        //     // invoke pagination
        //     //Calculate number of pages needed
        //     $displayLimit = 10; // ENTRIES PER PAGE
        //     $totalPages = ceil($srNum / $displayLimit);

        //     $paginatedResults = paginate($search, $page, $displayLimit);

        //     // This is the pagination bar (e.g. the HTML that goes under your search results)
        //     $paginationBar = pagination($totalPages, $page, $search);

        //     // Using the same function, but using the paginatedResults instead of all the results
        //     $searchDisplay = buildSearchResults($paginatedResults);
        // } else {
        //     $searchDisplay = buildSearchResults($sResults);
        // }

        // $searchDisplay = buildSearchResults($sResults);
        $_SESSION["vehicles"] = $sResults;
        $_SESSION["srNum"] = $srNum;

        // echo "<pre>";
        //     print_r($_SESSION["vehicles"]);
        // echo "</pre>";

        include '../view/search.php';
        break;

    default:
        include '../view/search.php';
        break;
    }
?>