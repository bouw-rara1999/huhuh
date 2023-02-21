<?php

// require_once __DIR__ . './../controllers/loginCont.php';

ob_start();
?>
<link rel="stylesheet" href="./public/css/homepage.style.css" />
<div id="formConnect">
    <form method="post" action="index.php?action=password.php">
        <label for="currentpassword">Current password:</label>
        <input type="text" id="currentpassword" name="currentpassword" placeholder="Current password..." required><br><br>
        <label for="newpassword">New password:</label>
        <input type="text" id="newpassword" name="newpassword" placeholder="New password..." required><br><br>
        <input type="submit" value="Submit">
    </form>
</div>
<?php
$content = ob_get_clean();

require_once __DIR__ . '/../templates/mainTemp.php';