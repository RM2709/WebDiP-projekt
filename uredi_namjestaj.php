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
    <title>Uredi namještaj</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za uređivanje namještaja">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
    <script src="javascript/rmilosevi.js" defer></script>
</head>

<body style="display: flex; flex-direction:column">
    <main style="flex:1">
    <?php
    $id = $_GET['id_namjestaj'];
    $naziv = $_GET['naziv'];
    $cijena = $_GET['cijena'];
    $sirina = $_GET['sirina'];
    $visina = $_GET['visina'];
    $duzina = $_GET['duzina'];
    $boja = $_GET['boja'];
    $materijal = $_GET['vrsta_materijala'];
    $idKategorije = $_GET['kategorija_namjestaja'];
    $nazivKategorije = $_GET['naziv_kategorije'];
    $status = $_GET['status_namjestaja'];
    $slika = $_GET['slika'];
    $boja1="";
    $boja2="";
    $boja3="";
    $boja4="";
    $boja5="";
    $boja6="";
    $boja7="";
    $boja8="";
    $boja9="";
    $boja10="";
    switch($boja)
    {
        case 1:{
            $boja1 = " selected";
            break;
        }
        case 2:{
            $boja2 = " selected";
            break;
        }
        case 3:{
            $boja3 = " selected";
            break;
        }
        case 4:{
            $boja4 = " selected";
            break;
        }
        case 5:{
            $boja5 = " selected";
            break;
        }
        case 6:{
            $boja6 = " selected";
            break;
        }
        case 7:{
            $boja7 = " selected";
            break;
        }
        case 8:{
            $boja8 = " selected";
            break;
        }
        case 9:{
            $boja9 = " selected";
            break;
        }
        case 10:{
            $boja10 = " selected";
            break;
        }
    }
    $materijal1="";
    $materijal2="";
    $materijal3="";
    $materijal4="";
    $materijal5="";
    $materijal6="";
    $materijal7="";
    $materijal8="";
    $materijal9="";
    $materijal10="";
    switch($materijal)
    {
        case 1:{
            $materijal1 = " selected";
            break;
        }
        case 2:{
            $materijal2 = " selected";
            break;
        }
        case 3:{
            $materijal3 = " selected";
            break;
        }
        case 4:{
            $materijal4 = " selected";
            break;
        }
        case 5:{
            $materijal5 = " selected";
            break;
        }
        case 6:{
            $materijal6 = " selected";
            break;
        }
        case 7:{
            $materijal7 = " selected";
            break;
        }
        case 8:{
            $materijal8 = " selected";
            break;
        }
        case 9:{
            $materijal9 = " selected";
            break;
        }
        case 10:{
            $materijal10 = " selected";
            break;
        }
    }
    $status1="";
    $status2="";
    $status3="";
    switch($status)
    {
        case 1:{
            $status1 = " selected";
            break;
        }
        case 2:{
            $status2 = " selected";
            break;
        }
        case 3:{
            $status3 = " selected";
            break;
        }
    }


    echo "
    <h1 style='text-align:center;font-size:45px;'>Uredi namještaj</h1>
    <form id='sidro' class='obrazac' action='uredi_namjestaj_.php?staraslika=".$slika."' method='POST' enctype='multipart/form-data'>
        <label for='naziv'>ID: </label>
        <input type='text' id='id' name='id' readonly value='$id'><br><br>
        <input type='hidden' id='idkategorije' name='idkategorije' value='$idKategorije'>
        <label for='kategorija'>Kategorija:</label>
        <input id='kategorija' name='kategorija' readonly required value='".$nazivKategorije."'><br><br>
        <label for='naziv'>Naziv: </label>
        <input type='text' id='naziv' name='naziv' required value='$naziv'><br><br>
        <label for='dirina'>Cijena:</label>
        <input type='number' id='cijena' name='cijena' required min='1' value='$cijena'><br><br>
        <label for='dirina'>Širina:</label>
        <input type='number' id='sirina' name='sirina' required min='1' value='$sirina'><br><br>
        <label for='dirina'>Dužina:</label>
        <input type='number' id='duzina' name='duzina' required min='1' value='$duzina'><br><br>
        <label for='visina'>Visina:</label>
        <input type='number' id='visina' name='visina' required min='1' value='$visina'><br><br>
        <label for='boja'>Boja:</label>
        <select id='boja' name='boja' required>
            <option value='1'$boja1>Crvena</option>
            <option value='2'$boja2>Plava</option>
            <option value='3'$boja3>Zelena</option>
            <option value='4'$boja4>Ljubičasta</option>
            <option value='5'$boja5>Žuta</option>
            <option value='6'$boja6>Cijan</option>
            <option value='7'$boja7>Roza</option>
            <option value='8'$boja8>Crna</option>
            <option value='9'$boja9>Bijela</option>
            <option value='10'$boja10>Siva</option>
        </select><br><br>
        <label for='materijal'>Materijal:</label>
        <select id='materijal' name='materijal' required>
            <option value='1'$materijal1>Hrastovina</option>
            <option value='2'$materijal2>Borovina</option>
            <option value='3'$materijal3>Iverica</option>
            <option value='4'$materijal4>Tkanina</option>
            <option value='5'$materijal5>Kamen</option>
            <option value='6'$materijal6>Baršun</option>
            <option value='7'$materijal7>Svila</option>
            <option value='8'$materijal8>Plastika</option>
            <option value='9'$materijal9>Aluminij</option>
            <option value='10'$materijal10>PVC</option>
        </select><br><br>
        <label for='status'>Status:</label>
        <select id='status' name='status' required>
            <option value='1'$status1>Dostupan</option>
            <option value='2'$status2>Kupljen</option>
            <option value='0'$status3>Nedostupan</option>
        </select><br><br>
        <label for='slika'>Slika:</label>
        <input type='file' name='slika' id='slika'><br><br>
        <input id='spremi' type='submit' value='Spremi'>
    </form>";
?>
    </main>
</body>
</html>

