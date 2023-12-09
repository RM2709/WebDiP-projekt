<?php
session_start();
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();
$target_dir = "slike/";
$target_file = $target_dir . basename($_FILES["slika"]["name"]);
$upload = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$kategorija = $_POST['idkategorije'];
$naziv = $_POST['naziv'];
$cijena = $_POST['cijena'];
$sirina = $_POST['sirina'];
$duzina = $_POST['duzina'];
$visina = $_POST['visina'];
$boja = $_POST['boja'];
$materijal = $_POST['materijal'];
$status = $_POST['status'];
$slika = basename($_FILES["slika"]["name"]);

if (file_exists($target_file)) {
    echo "<script>
    alert('Slika s ovim imenom već postoji!');
    window.location.href='namjestaj.php';
    </script>";
    $upload = 0;
}

if ($_FILES["slika"]["size"] > 500000) {
    echo "<script>
    alert('Odabrana datoteka je pre velika!');
    window.location.href='namjestaj.php';
    </script>";
    $upload = 0;
}


if ($upload == 1) {
    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
        $upit = "INSERT INTO namjestaj (naziv, cijena, sirina, visina, duzina, boja, vrsta_materijala, kategorija_namjestaja, status_namjestaja, slika, datum_unosa)
        VALUES ('$naziv', '$cijena', '$sirina', '$visina', '$duzina', '$boja', '$materijal', '$kategorija', '$status', '$slika', now())";
        $baza->updateDB($upit);
        $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Kreiranje novog namještaja', null);
        echo "<script>
        alert('Dodan novi namještaj!');
        window.location.href='namjestaj.php';
        </script>";
}
}
$baza->zatvoriDB();
?>