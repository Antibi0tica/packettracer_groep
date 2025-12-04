<?php
session_start();
require_once "includes/functions.php";

$user = getUserByID($_SESSION["user_id"] ?? 0);
if (!$user || $user["Rol"] !== "docent"){
    echo "Alleen docenten mogen hier komen.";
    exit;
};


$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
     
}



?>





<!DOCTYPE html>
<html>
<body>

<h2>Groepen Overzicht</h2>
<p>Ingelogd als: <?= $user["Naam"] ?> (<?= $user["Rol"] ?>)</p>

<form method="POST">
    <label>Groepsnaam:</label><br>
    <input type="text" name="Groepsnaam" required><br><br>
    <button type="submit">Verwijder</button>
</form>

<p><?= $message ?></p>

<a href="group_overview.php">Terug</a>

</body>
</html>




