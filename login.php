<?php
session_start();

require_once "includes/functions.php";

$users = readJson("gebruikers.json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["user_id"] = $_POST["GebruikerID"];
    header("Location: group_overview.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Fake Login</h2>

<form method="post">
    <label>Kies gebruiker:</label><br><br>

    <?php foreach ($users as $u): ?>
        <button type="submit" name="GebruikerID" value="<?= $u["GebruikerID"] ?>">
            <?= $u["Naam"] ?> (<?= $u["Rol"] ?>)
        </button><br><br>
    <?php endforeach; ?>

</form>

</body>
</html>
