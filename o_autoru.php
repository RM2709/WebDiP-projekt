<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
$_SESSION['dosao_sa'] = "o_autoru";
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>O autoru</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica s detaljima o autoru">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">O autoru</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <div class="o_autoru">
            <img src="materijali/rmilosevi.jpeg" alt="Slika autora (Roko Milošević)">
            <ul class="lista">
                <li>Ime: Roko</li>
                <li>Prezime: Milošević </li>
                <li>Email: <a class="poveznica" href="mailto:rmilosevi@foi.hr">rmilosevi@foi.hr</a></li>
                <li>Broj iksice: 0016141820</li>
                <li id="zivotopis">Životopis: Student treće godine studija Informacijskih Sustava na Fakultetu Organizacije i Informatike u Varaždinu. Interesi uključuju većinu tema vezanih za računala, informacije i slično, poput programiranja, dizajna, mreža, itd.</li>
            </ul>
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