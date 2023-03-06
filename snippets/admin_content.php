<form method="post" action='' >
    <fieldset>
    <?php
        if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == TRUE) && ($_SESSION['clientData']['clientLevel'] > 1)){
            echo "<legend>Managemenent Information</legend>";
            echo "<br>";
            echo "<h3>&emsp;Vehicle Managemenent</h3>";
            echo "<br>";
            echo "<p>&emsp;&emsp;Use the following button to update vehicle inventory:</p>";
            echo "<br>";
            echo "<input type='submit' name='action' value='Vehicle Management' formaction='/phpmotors/vehicles/index.php' class='submitBtn'>";
        } else {
            echo "<legend>Account Information</legend>";
        }
    ?>
        <h3>&emsp;Account Managemenent</h3>
        <br>
        <input type="submit" name="action" value="Update Account" formaction="/phpmotors/accounts/index.php?action=update_account_view" class="submitBtn">
        <br>
        <input type="submit" name="action" value="Update Password" formaction="/phpmotors/accounts/index.php?action=update_password_view" class="submitBtn">
        <br><br>
    </fieldset>
</form>