<?php
    include('baza.class.php');
    include_once('dnevnik.class.php');
    $baza = new Baza();
    $baza->spojiDB();
    $dnevnik = new Dnevnik();
    
    $idNarudzba = $_POST['idNarudzba'];
    $idKorisnik = $_POST['idKorisnik'];
    $upit = "UPDATE narudzba SET status_narudzbe=4 WHERE id_narudzba='$idNarudzba'";
    $uspjeh = $baza->selectDB($upit);
    $dnevnik->spremiDnevnik($idKorisnik, null, "Preuzimanje narudžbe", null);
    if($uspjeh)
    {
        echo json_encode('da');
    }
    else
    {
        echo json_encode('ne');
    }
?>