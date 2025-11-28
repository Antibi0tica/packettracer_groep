<?php
function readJson($file) {
    return json_decode(file_get_contents(__DIR__ . "/../data/" . $file), true);
}

function writeJson($file, $data) {
    file_put_contents(__DIR__ . "/../data/" . $file, json_encode($data, JSON_PRETTY_PRINT));
}

function generateGroupCode() {
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6); // Maak groepscode aan van a to z + 0-9 en je start bij 0 en het maximale is 6 letters/cijers 
}

function getUserById($id) {
    $users = readJson("gebruikers.json");
    foreach ($users as $u) {
        if ($u["GebruikerID"] == $id) return $u;
    }
    return null;
}
?>
