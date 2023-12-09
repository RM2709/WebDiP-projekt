<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
$_SESSION['dosao_sa'] = "upravljanje";
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Upravljanje aplikacijom</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za upravljanje sustavom">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Upravljanje aplikacijom</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
    </main>
    <hr>
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>

</html>