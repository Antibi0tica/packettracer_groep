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

function removeGroup() {

}

function getUserById($id) {
    $users = readJson("gebruikers.json"); // Maak een variabel van de gebruikers in de gebruikers.json Dus als voorbeeld $user = {"Docent Tim", "Student Lisa"} etc
    foreach ($users as $u) { // Hierbij maak je dus voor elke user lijn een $u. Waardoor alles bijvoorbeeld { "GebruikerID": 1, "Naam": "Docent Daniël", "Rol": "docent" }, word omgezet in 1, Docent Daniel, docent en word aangewezen aan $u
        if ($u["GebruikerID"] == $id) return $u; // Als de gebruikersid hetzelfde is van de gene die is ingelogd dan kan je doorgaan. 
    }
    return null; // Zoniet? Fout melding kan NIET doorgaan
}
?>
