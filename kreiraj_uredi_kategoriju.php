<?php
session_start();
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Uredi kategoriju namještaja</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za uređivanje kategorije namještaja">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
    <script src="javascript/rmilosevi.js" defer></script>
</head>

<body style="display: flex; flex-direction:column">
    <main style="flex:1">
        <?php
        if($_SESSION['dosao_sa']=="namjestaj")
        {
            if ($_GET['uredi'] != "da") {
                $naziv = $_GET['naziv'];
                $opis = $_GET['opis'];
                $upit = "INSERT INTO kategorija_namjestaja (naziv_kategorije, opis) VALUES ('$naziv', '$opis')";
                $baza->updateDB($upit);
                $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Kreiranje nove kategorije namjestaja', null);
                echo "<script>
                alert('Dodana nova kategorija namještaja!');
                window.location.href='namjestaj.php';
                </script>";
            } else {
                $id = $_GET['id'];
                $naziv = $_GET['naziv'];
                $opis = $_GET['opis'];
                echo "
                <h1 style='text-align:center;font-size:45px;'>Uredi kategoriju namještaja</h1>
                <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='kreiraj_uredi_kategoriju.php' method='GET'>
                    <label for='id'>ID: </label>
                    <input type='text' id='id' name='id' readonly required value='".$id."'><br><br>
                    <label for='naziv'>Naziv:</label>
                    <input type='text' id='naziv' name='naziv' required value='".$naziv."'><br><br>
                    <label for='opis'>Opis</label>
                    <input type='textarea' id='opis' name='opis' max=1000 value='".$opis."'><br><br>
                    <input id='kreiraj' type='submit' value='Spremi'>
                </form>
                ";
            }
        }
        else if($_SESSION['dosao_sa']=="uredi_namjestaj")
        {
                $id = $_GET['id'];
                $naziv = $_GET['naziv'];
                $opis = $_GET['opis'];
                $upit = "UPDATE kategorija_namjestaja SET naziv_kategorije='$naziv', opis='$opis' WHERE id_kategorija_namjestaja='$id'";
                $baza->updateDB($upit);
                $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, "Kategorija namještaja uređena (kategorija id: ".$id.")", null);
                echo "<script>
                alert('Kategorija namještaja uređena!');
                window.location.href='namjestaj.php';
                </script>";
        }
        
        $baza->zatvoriDB();
        $_SESSION['dosao_sa']="uredi_namjestaj";
        ?>
    </main>
</body>

</html>