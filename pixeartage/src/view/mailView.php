<?php

// require_once __DIR__ . './../controllers/loginCont.php';

ob_start();
?>

<link rel="stylesheet" href="./public/css/homepage.style.css" />
<div id="formConnect">
    <form method="post" action="index.php?action=mail.php">
        <label for="currentmail">Current mail:</label>
        <input type="text" id="currentmail" name="currentmail" placeholder="Current mail..." required><br><br>
        <label for="newpseudo">New mail:</label>
        <input type="text" id="newmail" name="newmail" placeholder="New mail..." required><br><br>
        <input type="submit" value="Submit">
    </form>
</div>
<?php
$content = ob_get_clean();

require_once __DIR__ . '/../templates/mainTemp.php';