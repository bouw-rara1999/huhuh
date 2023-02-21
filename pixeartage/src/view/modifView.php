<?php

// require_once __DIR__ . './../controllers/loginCont.php';

ob_start();
?>
<link rel="stylesheet" href="./public/css/homepage.style.css" />
<div id="formConnect">
    <form method="post" action="index.php?action=modif.php">
        <label for="currentpseudo">Current pseudo:</label>
        <input type="text" id="currentpseudo" name="currentpseudo" placeholder="Current pseudo..." required><br><br>
        <label for="newpseudo">New pseudo:</label>
        <input type="text" id="newpseudo" name="newpseudo" placeholder="New pseudo..." required><br><br>
        <input type="submit" value="Submit">
    </form>
</div>
<?php
$content = ob_get_clean();

require_once __DIR__ . '/../templates/mainTemp.php';