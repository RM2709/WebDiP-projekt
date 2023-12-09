<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$dnevnik = new Dnevnik();
$_SESSION['dosao_sa'] = "narudzbe";
$idKorisnika = $_SESSION['idKorisnika'];
?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Narudžbe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za upravljanje narudžbama">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
</head>

<body style="display: flex; flex-direction:column">
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Narudžbe</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <?php
        if (isset($_GET) && $_GET != null) {
            $baza->spojiDB();
            $id = $_GET['id'];
            $kategorija = $_GET['kategorija'];
            $naziv = $_GET['naziv'];
            $sirina = $_GET['sirina'];
            $duzina = $_GET['duzina'];
            $visina = $_GET['visina'];
            $boja = $_GET['boja'];
            $materijal = $_GET['materijal'];
            unset($_GET);
            $upit = "INSERT INTO namjestaj (naziv, sirina, visina, duzina, boja, vrsta_materijala, kategorija_namjestaja, status_namjestaja, datum_unosa)
                VALUES ('$naziv', '$sirina', '$visina', '$duzina', '$boja', '$materijal', '$kategorija', 0, now())";
            $baza->selectDB($upit);
            $upit = "SELECT * FROM namjestaj ORDER BY id_namjestaj DESC LIMIT 1";
            $rezultat = $baza->selectDB($upit);
            while ($red = $rezultat->fetch_array()) {
                $idNamjestaja = $red['id_namjestaj'];
            }
            $upit = "INSERT INTO narudzba (id_namjestaj, datum_narudzbe, status_narudzbe, narucitelj) VALUES ($idNamjestaja, now(), 1, '$idKorisnika')";
            $baza->selectDB($upit);
            $dnevnik->spremiDnevnik($idKorisnika, null, "Kreirao narudžbu novog namještaja", null);
            $baza->zatvoriDB();
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
            <h1 style='text-align:center;font-size:45px;'>Kreiraj narudžbu</h1>
            <form id='sidro' class='obrazac' action='narudzbe.php' method='GET'>
                <label for='naziv'>ID narudžbe: </label>
                <input type='text' id='id' name='id' readonly required'><br><br>
                <label for='kategorija'>Kategorija:</label>
                <select id='kategorija' name='kategorija' required>
                    " . $kategorije . "
                </select><br><br>
                <label for='naziv'>Naziv: </label>
                <input type='text' id='naziv' name='naziv' required><br><br>
                <label for='dirina'>Širina:</label>
                <input type='number' id='sirina' name='sirina' required min='1'><br><br>
                <label for='dirina'>Dužina:</label>
                <input type='number' id='duzina' name='duzina' required min='1'><br><br>
                <label for='visina'>Visina:</label>
                <input type='number' id='visina' name='visina' required min='1'><br><br>
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
                <input id='spremi' type='submit' value='Spremi'>
            </form>";
            echo "<table style='margin-top:20px;margin-bottom:30px'>";
            echo "
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Datum narudžbe</th>
                    <th>Cijena (HRK)</th>
                    <th>Datum isporuke</th>
                    <th>Status</th>
                    <th>Preuzimanje</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM narudzba INNER JOIN status_narudzbe ON narudzba.status_narudzbe=status_narudzbe.id_status_narudzbe WHERE narucitelj='$idKorisnika' ORDER BY datum_narudzbe, cijena";
            $odgovor = $baza->selectDB($upit);
            if ($odgovor) {
                while ($red = $odgovor->fetch_array()) {
                    $datumIsporuke = date_create($red['datum_i_vrijeme_isporuke']);
                    $datumDanas = new DateTime();
                    $statusid = "status" . $red['id_narudzba'];
                    if ($red['naziv_statusa_narudzbe'] == "U obradi") {
                        $idnam = $red['id_namjestaj'];
                        $upit = "SELECT * FROM namjestaj WHERE id_namjestaj='$idnam'";
                        $rez = $baza->selectDB($upit);
                        while ($row = $rez->fetch_array()) {
                            $uredi = "<td><a href='uredi_narudzbu.php?id=" . $red['id_narudzba'] . "&idnam=" . $red['id_namjestaj'] . "&kategorija=" . $row['kategorija_namjestaja'] . "&naziv=" . $row['naziv'] . "&sirina=" . $row['sirina'] . "&duzina=" . $row['duzina'] . "&visina=" . $row['visina'] . "&boja=" . $row['boja'] . "&materijal=" . $row['vrsta_materijala'] . "'>Uredi</a></td>";
                        }
                    } else {
                        $uredi = "<td></td>";
                    }
                    if ($red['naziv_statusa_narudzbe'] == "Dostava u tijeku" && ($datumIsporuke < $datumDanas)) {
                        $preuzmi = "<td><a id='preuzmi" . $red['id_narudzba'] . "' class='poveznica' onclick='preuzmi(" . $red['id_narudzba'] . ", " . $_SESSION['idKorisnika'] . ")'>Preuzmi</a></td>";
                    } else {
                        $preuzmi = "<td></td>";
                    }
                    echo "<tr>";
                    echo "
                        <td>" . $red['id_narudzba'] . "</td>
                        <td>" . $red['datum_narudzbe'] . "</td>
                        <td>" . $red['cijena'] . "</td>
                        <td>" . $red['datum_i_vrijeme_isporuke'] . "</td>
                        <td id='" . $statusid . "'>" . $red['naziv_statusa_narudzbe'] . "</td>" .
                        $preuzmi .
                        $uredi;
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
            $baza->zatvoriDB();
        }
        if ($_SESSION['uloga'] == 2) {
            $baza->spojiDB();
            $upit = "SELECT * FROM kategorija_namjestaja INNER JOIN moderatori_kategorije ON id_kategorija_namjestaja=id_kategorija WHERE id_korisnik='$idKorisnika'";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $idKategorije = $red['id_kategorija'];
            }

            echo "<table style='margin-top:20px;margin-bottom:30px'>";
            echo "
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Datum narudžbe</th>
                    <th>Cijena (HRK)</th>
                    <th>Datum isporuke</th>
                    <th>Status</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT *, DATE_FORMAT(datum_i_vrijeme_isporuke, '%Y-%m-%dT%H:%i') as datum_isporuke FROM narudzba INNER JOIN status_narudzbe ON narudzba.status_narudzbe=status_narudzbe.id_status_narudzbe INNER JOIN namjestaj ON narudzba.id_namjestaj=namjestaj.id_namjestaj WHERE kategorija_namjestaja='$idKategorije'";
            $odgovor = $baza->selectDB($upit);
            if ($odgovor) {
                while ($red = $odgovor->fetch_array()) {
                    $idNarudzbe = $red['id_narudzba'];
                    $datumIsporukeAkcija = "<td></td>";
                    if($red['naziv_statusa_narudzbe']=="Dostava u tijeku" && $red['datum_i_vrijeme_isporuke']==null)
                    {
                        $akcija = "<form id='form".$idNarudzbe."'>
                            <input id='input".$idNarudzbe."' type='datetime-local'>
                            <input onclick='narudzbeAkcija(".$idNarudzbe.", \"dodaj\")' type='button' value='Dodaj'>
                        </form>";
                    }
                    else if ($red['naziv_statusa_narudzbe']=="Dostava u tijeku" && $red['datum_i_vrijeme_isporuke']!=null)
                    {
                        $akcija = "<form id='form".$idNarudzbe."'>
                            <input id='input".$idNarudzbe."' type='datetime-local' value='".$red['datum_isporuke']."'>
                            <input onclick='narudzbeAkcija(".$idNarudzbe.", \"azuriraj\")' type='button' value='Ažuriraj'>
                        </form>";
                    }
                    else if ($red['naziv_statusa_narudzbe']=="Isporučen")
                    {
                        $akcija = "";
                    }
                    else if ($red['naziv_statusa_narudzbe']=="U obradi")
                    {
                        
                        $akcija = "<form id='form".$idNarudzbe."'>
                            <input id='input".$idNarudzbe."' type='number' placeholder='Cijena'>
                            <input onclick='narudzbeAkcija(".$idNarudzbe.", \"kreiraj\")' type='button' value='Kreiraj namještaj'>
                        </form>";
                    }
                    else if ($red['naziv_statusa_narudzbe']=="Naručen")
                    {
                        $akcija = "<form id='form".$idNarudzbe."'>
                            <input onclick='narudzbeAkcija(".$idNarudzbe.", \"potvrdi\")' type='button' value='Potvrdi kupnju'>
                        </form>";
                    }
                    echo "<tr>";
                    echo "
                        <td>" . $red['id_narudzba'] . "</td>
                        <td>" . $red['datum_narudzbe'] . "</td>
                        <td id=cijena".$red['id_narudzba'].">" . $red['cijena'] . "</td>
                        <td id=datum".$red['id_narudzba'].">" . $red['datum_i_vrijeme_isporuke'] . "</td>
                        <td id=status".$red['id_narudzba'].">" . $red['naziv_statusa_narudzbe'] . "</td>
                        <td>" . $akcija . "</td>";
                    echo "</tr>";
                }
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