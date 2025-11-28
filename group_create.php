<?php
session_start();
require_once "includes/functions.php";

$user = getUserById($_SESSION["user_id"] ?? 0);
if (!$user || $user["Rol"] !== "docent") {
    echo "Alleen docenten mogen hier komen.";
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $groepNaam = $_POST["Groepsnaam"];
    $code = generateGroupCode();

    $groepen = readJson("groepen.json");

    $groepen[] = [
        "GroepID" => count($groepen) + 1,
        "Groepsnaam" => $groepNaam,
        "Code" => $code,
        "BeheerderID" => $user["GebruikerID"]
    ];

    writeJson("groepen.json", $groepen);

    $message = "Groep succesvol aangemaakt! Groepscode: $code";
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Groep Aanmaken</h2>
<p>Ingelogd als: <?= $user["Naam"] ?> (docent)</p>

<form method="post">
    <label>Groepsnaam:</label><br>
    <input type="text" name="Groepsnaam" required><br><br>
    <button type="submit">Aanmaken</button>
</form>

<p><?= $message ?></p>

<a href="group_overview.php">Terug</a>

</body>
</html>
