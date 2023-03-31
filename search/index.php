<?php
    /*************************
     * Search Controller
     * Final Project End Code
     ************************/

    // Create or access a Session
    session_start();

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

    switch ($action) {
        case 'search':
            // This allows me to use a form with method="post" as well as pull the query from the pagination links
            $search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING)) ?: trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING));
            if (empty($search)) {
                $message = '<p class="notice">You must provide a search string.</p>';
                include '../view/search.php';
                exit;
            }

            // page is always pulled from the pagination links, so no need to look at the INPUT_POST
            $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
            if (empty($page)) {
                $page = 1;
            }

            $sResults = getSearchResults($search);

            $srNum = count($sResults);
            if ($srNum < 1) {
                $searchDisplay = '<h3 class="notice">Sorry, no results were found to match ' . $search . '.</h3>';
            } elseif ($srNum > 10) {
                // invoke pagination
                //Calculate number of pages needed
                $displayLimit = 10; // ENTRIES PER PAGE
                $totalPages = ceil($srNum / $displayLimit);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = (int) $_GET['page'];
                }

                $paginatedResults = paginate($search, $page, $displayLimit);
                $searchDisplay = buildSearchResults($paginatedResults);
                // This is the pagination bar (e.g. the HTML that goes under your search results)
                $paginationBar = pagination($totalPages, $page, $search);

            } else {
                $searchDisplay = buildSearchResults($sResults);
            }

            include '../view/search.php';
            break;
        default:
            include '../view/search.php';
            break;
    }