<header>
    <!-- Header -->
    <img src="/phpmotors/images/logo.png" alt="PHP Motors logo" class="img-logo">
    <!-- <a href='' class="account-link" style="text-align:right;float:right;padding-right:50px;padding-top:25px;";>My Account</a> -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?>
    
    <?php
        if(isset($_GET['page'])){
            $current_page = $_GET['page'];
            echo "<title>PHP Motors |", $current_page, "</title>";
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $current_page . '_content.php';
        }else{
            echo "<title>php Motors | Home</title>";
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/home_content.php';
        }
    ?>
</header>