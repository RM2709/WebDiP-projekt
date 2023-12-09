<?php
session_start();
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();
if ($_GET['obrisi'] != "da") {
    $korisnik = $_GET['korisnik'];
    $kategorija = $_GET['kategorija'];
    try{
        $upit = "INSERT INTO moderatori_kategorije (id_korisnik, id_kategorija) VALUES ('$korisnik', '$kategorija')";
        $baza->updateDB($upit);
        $upit2 = "UPDATE korisnik SET uloga_korisnika=2 WHERE id_korisnik='$korisnik'";
        $baza->updateDB($upit2);
        $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, "Dodijeljivanje moderatora (id: ".$korisnik.") kategoriji (id: ".$kategorija."", null);
        echo "<script>
                alert('Moderator dodijeljen kategoriji!');
                window.location.href='namjestaj.php';
                </script>";
    }
    catch (mysqli_sql_exception $e)
    {
        if ($e->getCode() == 1062) {
        echo "<script>
                alert('Korisnik je već moderator ove kategorije!');
                window.location.href='namjestaj.php';
                </script>";
        }
    }
    
} else {
    $korisnik = $_GET['korisnik'];
    $kategorija = $_GET['kategorija'];
    $upit = "DELETE FROM moderatori_kategorije WHERE id_korisnik='$korisnik' AND id_kategorija='$kategorija'";
    $baza->updateDB($upit);
    $upit2 = "UPDATE korisnik SET uloga_korisnika=1 WHERE id_korisnik='$korisnik'";
        $baza->updateDB($upit2);
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, "Moderator (id: ".$korisnik.") uklonjen iz kategorije (id: ".$kategorija."", null);
    echo "<script>
                alert('Moderator uklonjen iz kategorije!');
                window.location.href='namjestaj.php';
                </script>";
}
$baza->zatvoriDB();
