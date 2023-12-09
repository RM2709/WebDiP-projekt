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
    <title>Uredi popust</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za uređivanje popusta">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
    <script src="javascript/rmilosevi.js" defer></script>
</head>

<body style="display: flex; flex-direction:column">
    <main style="flex:1">
        <?php
        if($_SESSION['dosao_sa']=="popusti")
        {
            if ($_GET['uredi'] != "da") {
                $naziv = $_GET['naziv'];
                $iznos = $_GET['iznos'];
                $opis = $_GET['opis'];
                $upit = "INSERT INTO popust (naziv_popusta, iznos, opis) VALUES ('$naziv', '$iznos', '$opis')";
                $baza->updateDB($upit);
                $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, 'Kreiranje novog popusta', null);
                echo "<script>
                alert('Dodan novi popust!');
                window.location.href='popusti.php';
                </script>";
            } else {
                $id = $_GET['id'];
                $naziv = $_GET['naziv'];
                $iznos = $_GET['iznos'];
                $opis = $_GET['opis'];
                echo "
                <h1 style='text-align:center;font-size:45px;'>Uredi popust</h1>
                <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='kreiraj_uredi_popust.php' method='GET'>
                    <label for='id'>ID: </label>
                    <input type='text' id='id' name='id' readonly required value='".$id."'><br><br>
                    <label for='naziv'>Naziv:</label>
                    <input type='text' id='naziv' name='naziv' required value='".$naziv."'><br><br>
                    <label for='iznos'>Iznos (decimalno):</label>
                    <input type='number' id='iznos' name='iznos' required min='0' max='1' step='0.01' value='".$iznos."'><br><br>
                    <label for='opis'>Opis</label>
                    <input type='textarea' id='opis' name='opis' max=1000 value='".$opis."'><br><br>
                    <input id='kreiraj' type='submit' value='Spremi'>
                </form>
                ";
            }
        }
        else if($_SESSION['dosao_sa']=="uredi_popust")
        {
                $id = $_GET['id'];
                $naziv = $_GET['naziv'];
                $iznos = $_GET['iznos'];
                $opis = $_GET['opis'];
                $upit = "UPDATE popust SET naziv_popusta='$naziv', iznos='$iznos', opis='$opis' WHERE id_popust='$id'";
                $baza->updateDB($upit);
                $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], null, "Popust uređen (popust id: ".$id.")", null);
                echo "<script>
                alert('Popust uređen!');
                window.location.href='popusti.php';
                </script>";
        }
        
        $baza->zatvoriDB();
        $_SESSION['dosao_sa']="uredi_popust";
        ?>
    </main>
</body>

</html>