<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$dnevnik = new Dnevnik();
$idKorisnika = $_SESSION['idKorisnika'];
?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Uredi narudžbu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za uređivanje narudžbe">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
</head>

<body style="display: flex; flex-direction:column">
    <main style="flex:1">
        <?php
        $id = $_GET['id'];
        $idnam = $_GET['idnam'];
        $kategorija = $_GET['kategorija'];
        $naziv = $_GET['naziv'];
        $sirina = $_GET['sirina'];
        $duzina = $_GET['duzina'];
        $visina = $_GET['visina'];
        $boja = $_GET['boja'];
        $materijal = $_GET['materijal'];
        if ($_SESSION['dosao_sa']=="uredi_narudzbu") {
            $baza->spojiDB();
            $upit = "UPDATE namjestaj SET naziv='$naziv', sirina='$sirina', visina='$visina', duzina='$duzina', boja='$boja', vrsta_materijala='$materijal', kategorija_namjestaja='$kategorija' WHERE id_namjestaj='$idnam'";
            $baza->selectDB($upit);
            $dnevnik ->spremiDnevnik($idKorisnika, null, "Uredio narudžbu novog namještaja (id: ".$id.")", null);
            $baza->zatvoriDB();
            header("Location: narudzbe.php");
        }
        if ($_SESSION['uloga'] == 1) {
            $baza->spojiDB();
            $kategorije = "";
            $upit = "SELECT * FROM kategorija_namjestaja";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $kategorije = $kategorije . "<option value='" . $red['id_kategorija_namjestaja'] . "'>" . $red['naziv_kategorije'] . "</option> \n";
            }
            echo "
            <h1 style='text-align:center;font-size:45px;'>Uredi narudžbu</h1>
            <form id='sidro' class='obrazac' action='uredi_narudzbu.php' method='GET'>
                <label for='naziv'>ID narudžbe: </label>
                <input type='text' id='id' name='id' value='".$id."' readonly required'><br><br>
                <label for='kategorija'>Kategorija:</label>
                <select id='kategorija' name='kategorija' required value='".$kategorija."'>
                    " . $kategorije . "
                </select><br><br>
                <label for='naziv'>Naziv: </label>
                <input type='text' id='naziv' name='naziv' required value='".$naziv."'><br><br>
                <label for='dirina'>Širina:</label>
                <input type='number' id='sirina' name='sirina' required min='1' value='".$sirina."'><br><br>
                <label for='dirina'>Dužina:</label>
                <input type='number' id='duzina' name='duzina' required min='1' value='".$duzina."'><br><br>
                <label for='visina'>Visina:</label>
                <input type='number' id='visina' name='visina' required min='1' value='".$visina."'><br><br>
                <label for='boja'>Boja:</label>
                <select id='boja' name='boja' required>
                    <option value='1'>Crvena</option>
                    <option value='2'>Plava</option>
                    <option value='3'>Zelena</option>
                    <option value='4'>Ljubičasta</option>
                    <option value='5'>Žuta</option>
                    <option value='6'>Cijan</option>
                    <option value='7'>Roza</option>
                    <option value='8'>Crna</option>
                    <option value='9'>Bijela</option>
                    <option value='10'>Siva</option>
                </select><br><br>
                <label for='materijal'>Materijal:</label>
                <select id='materijal' name='materijal' required>
                    <option value='1'>Hrastovina</option>
                    <option value='2'>Borovina</option>
                    <option value='3'>Iverica</option>
                    <option value='4'>Tkanina</option>
                    <option value='5'>Kamen</option>
                    <option value='6'>Baršun</option>
                    <option value='7'>Svila</option>
                    <option value='8'>Plastika</option>
                    <option value='9'>Aluminij</option>
                    <option value='10'>PVC</option>
                </select><br><br>
                <input type='hidden' id='idnam' name='idnam' value='$idnam'>
                <input id='spremi' type='submit' value='Spremi'>
            </form>";
            echo "<table style='margin-top:20px'>";
            $baza->zatvoriDB();
            $_SESSION['dosao_sa'] = "uredi_narudzbu";
        }
        ?>
    </main>
</body>
</html>