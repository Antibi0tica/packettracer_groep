<?php
session_start();

require_once "includes/functions.php";

$users = readJson("gebruikers.json"); // Laad alle gebruikers van de json file naar dit bestand in een variabel

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Als de request methode POST is (Dus wat hier beneden staat)
    $_SESSION["user_id"] = $_POST["GebruikerID"]; // Tovert de Sessie ID naar gebruikerid
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
