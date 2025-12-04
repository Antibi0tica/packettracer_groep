<?php
session_start();
require_once "includes/functions.php";

$user = getUserById($_SESSION["user_id"] ?? 0);
if (!$user) {
    header("Location: login.php");
    exit;
}

$groepen = readJson("groepen.json");
$leden = readJson("groepsleden.json");
?>
<!DOCTYPE html>
<html>
<body>

<h2>Groepen Overzicht</h2>
<p>Ingelogd als: <?= $user["Naam"] ?> (<?= $user["Rol"] ?>)</p>

<a href="logout.php">Uitloggen</a><br><br>

<?php if ($user["Rol"] === "docent"): ?>

    <a href="group_create.php">➕ Nieuwe groep aanmaken</a>
    <a href="group_remove.php">➖ Verwijder groep</a>
    <h3>Jouw groepen</h3>

    <?php foreach ($groepen as $g): ?>
        <?php if ($g["BeheerderID"] == $user["GebruikerID"]): ?>
            <div style="margin-bottom:10px">
                <b><?= $g["Groepsnaam"] ?></b><br>
                Code: <?= $g["Code"] ?><br>
                Leden: 
                <?= count(array_filter($leden, fn($l) => $l["GroepID"] == $g["GroepID"])) ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php else: ?>

    <a href="group_join.php">➕ Word lid van een groep</a>

    <h3>Groepen waar jij lid van bent:</h3>

    <?php foreach ($leden as $l): ?>
        <?php if ($l["GebruikerID"] == $user["GebruikerID"]): ?>
            <?php 
            $groep = array_values(array_filter($groepen, fn($g) => $g["GroepID"] == $l["GroepID"]))[0];
            ?>
            <div>
                <?= $groep["Groepsnaam"] ?> (code: <?= $groep["Code"] ?>)
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
