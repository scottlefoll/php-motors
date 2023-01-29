<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Fill Me In">
    <meta name="author" content="SRL">
    <!-- This start file was build by Paul Cheney  -->
    <title>PHP Motors Account Signup</title>
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
                  <legend>Account Information</legend>
                  <label class="top" for="fname">First Name* <input type="text" id="fname" name="fname" value="" required></label>
                  <label class="top" for="lname">Last Name*  <input type="text" id="lname" name="lname" value="" required></label>
                  <label class="top" for="password">Password* <input type="text" id="pasword" name="password" value="" required></label>
                  <label class="top" for="phone">Phone* <input type="phone" id="phone" name="phone" value="" required></label>
                  <label class="top" for="email">Email *<input type="email" id="email" name="email" placeholder="someone@gmail.com" required></label>
              </fieldset>
              <input type="submit" value="Sign Up"  class="submitBtn">
          </form>

      </main>
      <footer>
          &copy; 2023 &bull; PHP Motors &bull;
      </footer>
  </body>
</html>
