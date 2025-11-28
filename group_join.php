<?php
session_start();
require_once "includes/functions.php";

$user = getUserById($_SESSION["user_id"] ?? 0);
if (!$user || $user["Rol"] !== "student") {
    echo "Alleen studenten mogen hier komen.";
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST["Groepscode"];
    $groepen = readJson("groepen.json");
    $groepsleden = readJson("groepsleden.json");

    $gevonden = null;
    foreach ($groepen as $g) {
        if ($g["Code"] === $code) {
            $gevonden = $g;
            break;
        }
    }

    if (!$gevonden) {
        $message = "Groep bestaat niet!";
    } else {
        $alLid = false;
        foreach ($groepsleden as $l) {
            if ($l["GebruikerID"] == $user["GebruikerID"] && $l["GroepID"] == $gevonden["GroepID"]) {
                $alLid = true;
                break;
            }
        }

        if ($alLid) {
            $message = "Je bent al lid!";
        } else {
            $groepsleden[] = [
                "GebruikerID" => $user["GebruikerID"],
                "GroepID" => $gevonden["GroepID"]
            ];

            writeJson("groepsleden.json", $groepsleden);
            $message = "Je bent toegevoegd aan de groep!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Bij groep komen</h2>
<p>Ingelogd als: <?= $user["Naam"] ?> (student)</p>

<form method="post">
    <label>Groepscode:</label><br>
    <input type="text" name="Groepscode" required><br><br>
    <button type="submit">Word lid</button>
</form>

<p><?= $message ?></p>

<a href="group_overview.php">Terug</a>

</body>
</html>
