<?php
session_start();
$_SESSION['dosao_sa']="aktiviraj";
$email = $_GET['email'];
$kod = $_GET['kod'];
include('../baza.class.php');
include('../dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();

$upit = "SELECT * FROM korisnik WHERE aktivacijski_kod='$kod'";
$rezultat = $baza->selectDB($upit);


if($red = $rezultat->fetch_array()) {
$vrijemeRegistracije = date_create($red['datum_registracije']);
$id = $red['id_korisnik'];
}

$vrijemeRegistracije = date_add($vrijemeRegistracije, date_interval_create_from_date_string("7 hours"));
$vrijemeTrenutno = new DateTime();

if($vrijemeRegistracije > $vrijemeTrenutno)
{
    $upit = "UPDATE korisnik SET status_racuna=1 WHERE aktivacijski_kod='$kod'";
    $baza->selectDB($upit);
    $dnevnik->spremiDnevnik($id, null, null, "Aktivacija računa");
    header("Location: prijava.php");
}
else
{
    $upit = "DELETE FROM korisnik WHERE aktivacijski_kod='$kod'";
    $baza->selectDB($upit);
    header("Location: registracija.php");
}

$baza->zatvoriDB();
?>