<?php
include('../baza.class.php');
$korime = $_POST['korime'];
if (isset($_POST['korime'])) {
    $korime = $_POST['korime'];
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "select * from korisnik";
    $rezultat = $baza->selectDB($upit)->fetch_all(MYSQLI_ASSOC);
    $postoji = false;
    foreach ($rezultat as $red) {
        if ($red['korisnicko_ime'] == $korime) {
            $postoji = true;
        }
    }

    $baza->zatvoriDB();

    if ($postoji) {
        echo json_encode('da');
    } else {
        echo json_encode('ne');
    }
}
