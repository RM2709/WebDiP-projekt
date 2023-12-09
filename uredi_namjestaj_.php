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


$staraSlika = $_GET['staraslika'];
$id = $_POST['id'];
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

if ($_FILES["slika"]["size"] > 500000) {
    echo "<script>
    alert('Odabrana datoteka je pre velika!');
    window.location.href='namjestaj.php';
    </script>";
    $upload = 0;
}


if ($upload == 1) {
    unlink($target_dir . $staraSlika);
    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
        $upit = "UPDATE namjestaj SET naziv='$naziv', cijena='$cijena', sirina='$sirina', visina='$visina', duzina='$duzina', boja='$boja', vrsta_materijala='$materijal', kategorija_namjestaja='$kategorija', status_namjestaja='$status', slika='$slika' WHERE id_namjestaj='$id'";
        $baza->updateDB($upit);
        $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Ažuriranje namještaja (id: '.$id.')', null);
        echo "<script>
        alert('Namještaj ažuriran!');
        window.location.href='namjestaj.php';
        </script>";
}
}
$baza->zatvoriDB();
?>