<head>
    <meta charset="UTF-8">
    <meta name="color" content="blue">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Scott LeFoll">
    <meta name="description" content="PHP Motors is a website that sells cars.">

    <link rel="short_icon" href="favicon.ico">
    <link rel="icon" sizes="72x180" href="logo.png">
    
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <!-- <link rel="stylesheet" media="screen" href="css/base.css"> -->
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <!-- <link rel="stylesheet" media="screen and (min-width:600px) href="css/medium.css"> -->
    <!-- <link rel="stylesheet" media="screen and (min-width:800px) href="css/large.css"> -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href='https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap'>;
    <title>php Motors</title>
    <?php 
        $currentPage= $_SERVER['SCRIPT_NAME'];
        $currentPage = substr($currentPage, 1);
    ?>

  </head>