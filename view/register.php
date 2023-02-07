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
                        <legend>Account Information</legend>
                        <label class="top" for="fname">First Name* <input type="text" id="fname" name="fname" value="" required></label>
                        <label class="top" for="lname">Last Name*  <input type="text" id="lname" name="lname" value="" required></label>
                        <label class="top" for="password">Password* <input type="text" id="password" name="password" value="" required></label>
                        <label class="top" for="phone">Phone* <input type="tel" id="phone" name="phone" value="" required></label>
                        <label class="top" for="email">Email *<input type="email" id="email" name="email" placeholder="someone@gmail.com" required></label>
                    </fieldset>
                    <input type="submit" value="Sign Up"  class="submitBtn">
                </form>
            </main>

            <!-- Footer -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
        </div>
    </body>
</html>
