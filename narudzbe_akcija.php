<?php
session_start();
include('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$dnevnik = new Dnevnik();

$baza->spojiDB();
$akcija = $_POST['akcija'];
$idNarudzbe = $_POST['idNarudzbe'];
$podaci = $_POST['podaci'];

if($akcija=="dodaj")
{
    $upit = "UPDATE narudzba SET datum_i_vrijeme_isporuke='$podaci' WHERE id_narudzba='$idNarudzbe'";
    $baza->updateDB($upit);
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Dodavanje datuma i vremena isporuke (id narudžbe: '.$idNarudzbe.')', null);
}
if($akcija=="azuriraj")
{
    $upit = "UPDATE narudzba SET datum_i_vrijeme_isporuke='$podaci' WHERE id_narudzba='$idNarudzbe'";
    $baza->updateDB($upit);
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Ažuriranje datuma i vremena isporuke (id narudžbe: '.$idNarudzbe.')', null);
}
if($akcija=="kreiraj")
{
    $upit = "SELECT * FROM narudzba WHERE id_narudzba='$idNarudzbe'";
    $odgovor = $baza->selectDB($upit);
    while ($red = $odgovor->fetch_array()) {
        $idNamjestaj=$red['id_namjestaj'];
    }
    $upit = "UPDATE namjestaj SET status_namjestaja=2, cijena='$podaci' WHERE id_namjestaj='$idNamjestaj'";
    $odgovor = $baza->selectDB($upit);
    $upit = "UPDATE narudzba SET status_narudzbe=3, cijena='$podaci' WHERE id_narudzba='$idNarudzbe'";
    $baza->updateDB($upit);
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: '.$idNarudzbe.', id namještaja: '.$idNamjestaj.')', null);
}
if($akcija=="potvrdi")
{
    $upit = "UPDATE narudzba SET status_narudzbe=3 WHERE id_narudzba='$idNarudzbe'";
    $baza->updateDB($upit);
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Potvrđivanje narudžbe (id narudžbe: '.$idNarudzbe.')', null);
    $upit = "SELECT * FROM narudzba WHERE id_narudzba='$idNarudzbe'";
    $odgovor = $baza->selectDB($upit);
    while ($red = $odgovor->fetch_array()) {
        $idNamjestaj=$red['id_namjestaj'];
    }
    $upit = "UPDATE namjestaj SET status_namjestaja=2 WHERE id_namjestaj='$idNamjestaj'";
    $odgovor = $baza->selectDB($upit);
}

$baza->zatvoriDB();

echo json_encode($podaci);
?>