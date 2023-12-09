<?php
    session_start();
    $direktorij = getcwd();
    //$putanja = "/webdip_projekt";
    $putanja = "/WebDiP/2021_projekti/WebDiP2021x075";
    $_SESSION['dosao_sa']="index";
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Roko Milošević">
        <meta name="description" content="Stranica kreirana 18.03.2022.">
        <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="javascript/rmilosevi_jquery.js"></script>
        <?php
        echo  "<script src=\"$putanja/javascript/rmilosevi.js\" type=\"text/javascript\"></script>";
        ?>
        
    </head>
    <body style="display: flex; flex-direction:column"> 
        <header id="zaglavlje">
            <span class="izbornik">
                <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik"/> </a>
            </span>
            <a href="#header-tekst">Početna stranica</a>
            <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo"/> </a>
            </span>
        </header>
        <?php
            include "meni.php";
        ?>
        <hr>
        <main style="flex:1">
            <div id="pocetni-odabir">
                <ul>
                    <?php
                        echo  "<li><a href=\"$putanja/o_autoru.php\">O autoru</a></li>";
                        echo  "<li><a href=\"$putanja/dokumentacija.php\">Dokumentacija</a></li>";
                        echo  "<li><a href=\"$putanja/namjestaj.php\">Namještaj</a></li>";
                        if (!isset($_SESSION['uloga'])) {
                            echo  "<li><a href=\"$putanja/obrasci/registracija.php\">Registracija</a></li>";
                        }
                        if (isset($_SESSION['uloga'])) {
                            echo  "<li><a href=\"$putanja/obrasci/prijava.php\">Odjava</a></li>";
                        } else {
                            echo  "<li><a href=\"$putanja/obrasci/prijava.php\">Prijava</a></li>";
                        }                       
                        if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 1) {
                            echo  "<li><a href=\"$putanja/statistika.php\">Statistika</a></li>";
                            echo  "<li><a href=\"$putanja/narudzbe.php\">Narudžbe</a></li>";
                        }                    
                        if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 2) {
                            echo  "<li><a href=\"$putanja/popusti.php\">Popusti</a></li>";
                        }           
                        if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 3) {
                            echo  "<li><a href=\"$putanja/upravljanje.php\">Upravljanje aplikacijom</a></li>";
                            echo  "<li><a href=\"$putanja/korisnici.php\">Korisnici</a></li>";
                            echo  "<li><a href=\"$putanja/dnevnik.php\">Dnevnik</a></li>";
                        }
                    ?>
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