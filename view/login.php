
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
            <link href="../css/small-forms.css" rel="stylesheet">
            <!-- enhance-desktop -->
            <link href="../css/large-forms.css" rel="stylesheet">
                
            <nav class="nav"><?php echo $navList; ?></nav>

            <!-- Main -->
            <main>
                <br>
                <form method="get" action= "../accounts/index.php">
                    <fieldset>
                        <legend>Login Information</legend>
                        <label class="top" for="username">Username* <input type="text" id="username" name="username" value="" required></label>
                        <label class="top" for="password">Password*  <input type="text" id="password" name="password" value="" required></label>
                    </fieldset>
                    <input type="submit" value="Login"  class="submitBtn">
                    <div class="signup"><p>No account? <button onclick="window.location.href='/phpmotors/accounts/index.php?action=register';" class="signupbtn">Sign Up</button></p></div>
                </form>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
