<?php
include_once('../dnevnik.class.php');
$dnevnik = new Dnevnik();
session_start();
//ODJAVA
if($_SESSION['dosao_sa']!="prijava" && isset($_SESSION['idKorisnika']))
{
    $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], "odjava");
    unset($_SESSION['idKorisnika']);
    unset($_SESSION['korime']);
    unset($_SESSION['uloga']);
}
if(isset($_SESSION['idKorisnika']) && isset($_SESSION['korime']) && isset($_SESSION['uloga']))
{
    header("Location: ../index.php");
}

$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
include_once('../baza.class.php');

$baza = new Baza();
$baza->spojiDB();



$_SESSION['dosao_sa'] = "prijava";
 
//PRIJAVA PUTEM HTTPS-a
if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

// PAMCENJE PRIJAVLJENOG KORISNIKA
if (isset($_GET['zapamti-me']) && $_GET['zapamti-me'] == 'Da') {
    setcookie("korisnik", $_GET['korime'], false, "/", false);
} else if(isset($_GET['zapamti-me'])){
    setcookie("korisnik", "", time() - 3600, "/", false);
}
// PAMCENJE PRIJAVLJENOG KORISNIKA - Citia zapamcenog i kasnije ga pise u formu
$cookieKorime = "";
if(isset($_COOKIE['korisnik']))
{
    $cookieKorime = $_COOKIE['korisnik'];
}


if (isset($_GET['PrijaviSe'])){
    $korime = $_GET['korime'];
    $lozinka = $_GET['lozinka'];

    echo
    "<script>
        var xhr = new XMLHttpRequest();
        var url = 'klasa_prijava.php?korime=$korime&lozinka=$lozinka';
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var odgovor = this.responseText;
                if(odgovor != '')
                {
                    alert(odgovor);
                    if(odgovor == 'Ne postoji korisnik s tim korisničkim imenom')
                    {
                        let labele = document.getElementsByTagName('label');
                        let unosi = document.getElementsByTagName('input');
                        for(let i = 0; i < labele.length; i++) {
                            labele[i].style.color = 'red';
                        }
                        for(let i = 0; i < unosi.length; i++) {
                            unosi[i].style.border = '3px solid red';
                        }
                    }
                }
                else
                {
                    document.location.reload(true);
                }
            }
        }
        xhr.open('GET', url, true);
        xhr.send();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Prijava</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za prijavu u sustav">
    <link href="../css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../javascript/rmilosevi_jquery.js"></script>
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="../materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Prijava</a>
        <span class="logo"> <a href="index.php"> <img src="../materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "../meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <div class="obrazac" id="obrazac-prijava">
            <form novalidate method="GET" name="obrazac-prijava" action="prijava.php">
                <label for="korime">Korisničko ime: </label>
                <input type="text" id="korime" name="korime" size="30" maxlength="30" placeholder="Korisničko ime" autofocus="autofocus" required="required" value='<?php echo $cookieKorime; ?>'>
                <br><br><label for="lozinka">Lozinka: </label>
                <input type="password" id="lozinka" name="lozinka" size="30" maxlength="30" placeholder="Lozinka" required="required">
                <br><br><label for="zapamti-me">Zapamti me: </label>
                <input id="zapamti-me" type="radio" name="zapamti-me" value="Da">Da
                <input type="radio" name="zapamti-me" checked value="Ne">Ne
                <br><br><input class="gumb" name="PrijaviSe" type="submit" value=" Prijavi se">
                <br><br><a id="zaboravljena-lozinka" class="poveznica">Zaboravljena lozinka? Resetiraj!</a><br>
            </form>
        </div>
    </main>
    <hr>
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>
</html>

<?php
    $baza->zatvoriDB();
?>