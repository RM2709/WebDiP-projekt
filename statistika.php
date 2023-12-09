<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
$_SESSION['dosao_sa'] = "statistika";
include_once('baza.class.php');
$baza = new Baza();
$idKorisnika = $_SESSION['idKorisnika'];
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Statistika</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za pregledavanje statistike">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
</head>

<body style="display: flex; flex-direction:column">
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Statistika</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <?php
        if ($_SESSION['uloga'] == 1) {
            $baza->spojiDB();
            echo "<table style='margin-top:20px'>";
            echo "<caption class='tablica-naslov'>Broj kupljenog namještaja</caption>";
            echo "
            <thead>
                <tr>
                    <th>Godina</th>
                    <th>Mjesec</th>
                    <th>Broj namještaja</th>
                </tr>
            </thead>
            <tbody>";
            
            $upit = "SELECT YEAR(datum_narudzbe) as godina, MONTH(datum_narudzbe) as mjesec, COUNT(*) as broj FROM narudzba WHERE narucitelj='$idKorisnika' GROUP BY godina, mjesec ORDER BY godina DESC, mjesec DESC";
            $odgovor = $baza->updateDB($upit);
            while ($red = $odgovor->fetch_array()) {
                echo "<tr>";
                echo "
                <td>" . $red['godina'] . "</td>
                <td>" . $red['mjesec'] . "</td>
                <td>" . $red['broj'] . "</td>
                ";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $baza->zatvoriDB();
        }
        if ($_SESSION['uloga'] >= 2) {
            $baza->spojiDB();
            echo "<table style='margin-top:20px'>";
            echo "<caption class='tablica-naslov'>Zarada kupljenog namještaja</caption>";
            echo "
            <thead>
                <tr>
                    <th>Boja</th>
                    <th>Materijal</th>
                    <th>Zarada (HRK)</th>
                </tr>
            </thead>";
            echo "<tbody>";
            $upit = "SELECT * FROM kategorija_namjestaja INNER JOIN moderatori_kategorije ON id_kategorija_namjestaja=id_kategorija WHERE id_korisnik='$idKorisnika'";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $idKategorije = $red['id_kategorija'];
            }
            //$upit = "SELECT boja.naziv_boje as boja, materijal.naziv_materijala as mat, SUM(cijena) as zarada FROM namjestaj INNER JOIN boja ON namjestaj.boja=boja.id_boja INNER JOIN materijal ON namjestaj.vrsta_materijala=materijal.id_materijal GROUP BY boja, mat ORDER BY boja ASC, mat ASC";
            $upit = "SELECT boja.naziv_boje as boja, materijal.naziv_materijala as mat, SUM(narudzba.cijena) as zarada FROM narudzba INNER JOIN namjestaj ON narudzba.id_namjestaj=namjestaj.id_namjestaj INNER JOIN boja ON namjestaj.boja=boja.id_boja INNER JOIN materijal ON namjestaj.vrsta_materijala=materijal.id_materijal WHERE kategorija_namjestaja='$idKategorije' GROUP BY boja, mat ORDER BY boja ASC, mat ASC";
            $odgovor = $baza->updateDB($upit);
            while ($red = $odgovor->fetch_array()) {
                echo "<tr>";
                echo "
                <td>" . $red['boja'] . "</td>
                <td>" . $red['mat'] . "</td>
                <td>" . $red['zarada'] . "</td>
                ";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $baza->zatvoriDB();
        }
        ?>
    </main>
    <hr>
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>

</html>