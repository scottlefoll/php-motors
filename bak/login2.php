<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Fill Me In">
    <meta name="author" content="SRL">
    <!-- This start file was build by Paul Cheney  -->
    <title>PHP Motors Login</title>
    <!-- TELLS PHONES NOT TO LIE ABOUT THEIR WIDTH & stops the font from enlarging when a phone is turned sideways-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- STYLE SHEETS -->
    <link href="../css/normalize.css" rel="stylesheet">
    <!-- phone-default -->
    <link href="../css/small-forms.css" rel="stylesheet">
    <!-- enhance-desktop -->
    <link href="../css/large-forms.css" rel="stylesheet">

  </head>

  <body>
  	 <header>
        <h1>PHP Motors</h1>
      </header>

      <main>
          <form method="get" action= "../accounts/index.php">
              <fieldset>
                  <legend>Login Information</legend>
                  <label class="top" for="username">Username* <input type="text" id="fname" name="username" value="" required></label>
                  <label class="top" for="password">Password*  <input type="text" id="lname" name="password" value="" required></label>
              </fieldset>
              <input type="submit" value="Login"  class="submitBtn">
              <div class="signup"><p>No account? <button onclick="window.location.href='/phpmotors/view/register.php?action=register';" class="signupbtn">Sign Up</button></p></div>
          </form>
      </main>
      <footer>
          &copy; 2023 &bull; PHP Motors &bull;
      </footer>
      <script src="js/scripts.js"></script>
  </body>
</html>
