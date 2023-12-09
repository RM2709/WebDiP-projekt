<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
include_once('baza.class.php');
include_once('dnevnik.class.php');
$baza = new Baza();
$dnevnik = new Dnevnik();
$_SESSION['dosao_sa'] = "namjestaj";
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Namještaj</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za pregledavanje i upravljanje namještajem">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
</head>

<body style="display: flex; flex-direction:column">
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Namještaj</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <?php
        if (!isset($_SESSION['uloga'])) {
            echo "<div class='galerija'>";
            $popust = "";
            if (isset($_GET['popust'])) {
                $popust = "checked";
            }
            $cijena_asc = "";
            $cijena_desc = "";
            $boja = "";
            if (isset($_GET['sortiraj'])) {
                switch ($_GET['sortiraj']) {
                    case "cijena_asc":
                        $cijena_asc = "selected";
                        break;
                    case "cijena_desc":
                        $cijena_desc = "selected";
                        break;
                    case "boja":
                        $boja = "selected";
                        break;
                }
            } else {
                $cijena_asc = "selected";
            }
            echo "
            <h1 style='text-align:center;font-size:45px'>Galerija slika</h1>
            <form id='sortiranje_pretrazivanje' action='namjestaj.php' method='GET'>
                <label for='popust'>Prikaži samo namještaj na popustu </label>
                <input type='checkbox' id='popust' name='popust' " . $popust . ">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label for='sortiraj'>Sortiraj po: </label>
                <select id='sortiraj' name='sortiraj'>
                        <option value='cijena_asc'$cijena_asc>Cijeni (niža->viša)</option>
                        <option value='cijena_desc'$cijena_desc>Cijeni (viša->niža)</option>
                        <option value='boja'$boja>Boji (abecedno)</option>
                </select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input id='primjeni' type='submit' value='Primjeni'>
            </form>";
            $baza->spojiDB();
            if (isset($_GET['popust'])) {
                if ($cijena_asc != "") {
                    $upit = "SELECT * FROM namjestaj INNER JOIN popust_namjestaja ON namjestaj.id_namjestaj=popust_namjestaja.id_namjestaja ORDER BY cijena ASC, naziv";
                } else if ($cijena_desc != "") {
                    $upit = "SELECT * FROM namjestaj INNER JOIN popust_namjestaja ON namjestaj.id_namjestaj=popust_namjestaja.id_namjestaja ORDER BY cijena DESC, naziv";
                } else if ($boja != "") {
                    $upit = "SELECT * FROM namjestaj INNER JOIN popust_namjestaja ON namjestaj.id_namjestaj=popust_namjestaja.id_namjestaja ORDER BY boja, naziv";
                }
            } else {
                if ($cijena_asc != "") {
                    $upit = "SELECT * FROM namjestaj ORDER BY cijena ASC, naziv";
                } else if ($cijena_desc != "") {
                    $upit = "SELECT * FROM namjestaj ORDER BY cijena DESC, naziv";
                } else if ($boja != "") {
                    $upit = "SELECT * FROM namjestaj ORDER BY boja, naziv";
                }
            }
            $rezultat = $baza->selectDB($upit);
            foreach ($rezultat as $red) {
                $url = 'slike/' . $red["slika"];
                $naziv = $red["naziv"];
                $id = $red["id_namjestaj"];
                if($red['slika']!="")
                {
                    echo "
                <a target='_blank' href='$url'>
                    <img src='$url' alt='$naziv'>
                </a>
                ";
                } 
            }

            if (isset($_GET['od']) && isset($_GET['do'])) {
                $od = $_GET['od'];
                $do = $_GET['do'];
            } else {
                $od = "";
                $do = "";
            }
            echo "</div>";
            echo "
            <h1 style='text-align:center;font-size:45px;'>Namještaj po kategoriji</h1>
            <form id='sidro' style='text-align:center;padding:20px;padding-top:0px;' action='namjestaj.php#sidro' method='GET'>
                <label for='od'>Od</label>
                <input type='datetime-local' id='od' name='od' value='" . $od . "'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label for='do'>Do</label>
                <input type='datetime-local' id='do' name='do' value='" . $do . "'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input id='primjeni' type='submit' value='Primjeni'>
            </form>";
            echo "<table>";
            echo "
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Datum unosa</th>
                </tr>
            </thead>
            <tbody>
            ";
            $od = date("Y-m-d H:i:s", strtotime($od));
            $do = date("Y-m-d H:i:s", strtotime($do));
            $upit = "SELECT * FROM namjestaj INNER JOIN kategorija_namjestaja ON namjestaj.kategorija_namjestaja=kategorija_namjestaja.id_kategorija_namjestaja WHERE (datum_unosa BETWEEN '$od' AND '$do') ORDER BY naziv_kategorije ASC, datum_unosa ASC";
            $odgovor = $baza->selectDB($upit);
            if ($odgovor) {
                while ($red = $odgovor->fetch_array()) {
                    echo "<tr>";
                    echo "
                        <td>" . $red['naziv'] . "</td>
                        <td>" . $red['naziv_kategorije'] . "</td>
                        <td>" . $red['datum_unosa'] . "</td>
                        ";
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
            $baza->zatvoriDB();
        } else if ($_SESSION['uloga'] == 1) {
            $baza->spojiDB();
            echo "<table style='margin-top:20px'>";
            echo "
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Cijena (HRK)</th>
                    <th>Popust</th>
                    <th>Naruči</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM namjestaj INNER JOIN kategorija_namjestaja ON namjestaj.kategorija_namjestaja=kategorija_namjestaja.id_kategorija_namjestaja LEFT JOIN popust_namjestaja ON namjestaj.id_namjestaj=popust_namjestaja.id_namjestaja LEFT JOIN popust ON popust_namjestaja.id_popust=popust.id_popust WHERE traje_do > now() OR traje_do IS NULL";
            $odgovor = $baza->selectDB($upit);
            if ($odgovor) {
                while ($red = $odgovor->fetch_array()) {
                    if ($red['status_namjestaja'] > 0) {
                        if ($red['naziv_popusta'] != "") {
                            $popust = "<td>" . $red['naziv_popusta'] . " (" . ($red['iznos'] * 100) . "%)</td>";
                            $cijenaPopust = $red['cijena'] - ($red['cijena'] * $red['iznos']);
                        } else {
                            $popust = "<td></td>";
                            $cijenaPopust = $red['cijena'];
                        }
                        echo "<tr>";
                        echo "
                            <td>" . $red['naziv'] . "</td>
                            <td>" . $red['naziv_kategorije'] . "</td>
                            <td>" . $red['cijena'] . "</td>" .
                            $popust .
                            "<td><a id='naruci' class='poveznica' onclick='naruci(" . $red['id_namjestaj'] . ", " . $_SESSION['idKorisnika'] . ", " . $cijenaPopust . ")'>Naruči</a></td>";
                        echo "</tr>";
                    }
                }
            }
            echo "</tbody>";
            echo "</table>";
            $baza->zatvoriDB();
        } else if ($_SESSION['uloga'] == 2) {
            $idKorisnika = $_SESSION['idKorisnika'];
            $baza->spojiDB();
            $upit = "SELECT * FROM moderatori_kategorije INNER JOIN kategorija_namjestaja ON moderatori_kategorije.id_kategorija=kategorija_namjestaja.id_kategorija_namjestaja WHERE id_korisnik='$idKorisnika'";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $idKategorije = $red['id_kategorija'];
                $nazivKategorije = $red['naziv_kategorije'];
            }
            echo "
            <h1 style='text-align:center;font-size:45px;'>Kreiraj namještaj</h1>
            <form id='sidro' class='obrazac' action='kreiraj_namjestaj.php' method='POST' enctype='multipart/form-data'>
                <label for='id'>ID: </label>
                <input type='text' id='id' name='id' readonly required'><br><br>
                <input type='hidden' id='idkategorije' name='idkategorije' value='$idKategorije'>
                <label for='kategorija'>Kategorija:</label>
                <input id='kategorija' name='kategorija' readonly required value='" . $nazivKategorije . "'><br><br>
                <label for='naziv'>Naziv: </label>
                <input type='text' id='naziv' name='naziv' required><br><br>
                <label for='dirina'>Cijena:</label>
                <input type='number' id='cijena' name='cijena' required min='1'><br><br>
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
                <label for='status'>Status:</label>
                <select id='status' name='status' required>
                    <option value='1'>Dostupan</option>
                    <option value='2'>Kupljen</option>
                    <option value='0'>Nedostupan</option>
                </select><br><br>
                <label for='slika'>Slika:</label>
                <input type='file' name='slika' id='slika'><br><br>
                <input id='spremi' type='submit' value='Spremi'>
            </form>";
            echo "<table style='margin-top:20px;margin-bottom:20px'>";
            echo "<caption style='font-size:45px;font-weight:bolder;margin-bottom:15px'>Namještaj</caption>";
            echo "
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Cijena (HRK)</th>
                    <th>Širina</th>
                    <th>Visina</th>
                    <th>Dužina</th>
                    <th>Boja</th>
                    <th>Materijal</th>
                    <th>Kategorija</th>
                    <th>Status</th>
                    <th>Slika</th>
                    <th>Datum unosa</th>
                    <th>Uredi</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM namjestaj INNER JOIN status_namjestaja ON namjestaj.status_namjestaja=status_namjestaja.id_status_namjestaja INNER JOIN boja ON namjestaj.boja=boja.id_boja INNER JOIN materijal ON namjestaj.vrsta_materijala=materijal.id_materijal INNER JOIN kategorija_namjestaja ON namjestaj.kategorija_namjestaja=kategorija_namjestaja.id_kategorija_namjestaja WHERE kategorija_namjestaja='$idKategorije'";
            $odgovor = $baza->selectDB($upit);
            if ($odgovor) {
                while ($red = $odgovor->fetch_array()) {
                    $podaci = http_build_query($red);
                    $url = 'slike/' . $red["slika"];
                    $naziv = $red["naziv"];
                    echo "<tr>";
                    echo "
                        <td>" . $red['id_namjestaj'] . "</td>
                        <td>" . $red['naziv'] . "</td>
                        <td>" . $red['cijena'] . "</td>
                        <td>" . $red['sirina'] . "</td>
                        <td>" . $red['visina'] . "</td>
                        <td>" . $red['duzina'] . "</td>
                        <td>" . $red['naziv_boje'] . "</td>
                        <td>" . $red['naziv_materijala'] . "</td>
                        <td>" . $red['naziv_kategorije'] . "</td>
                        <td>" . $red['naziv_statusa'] . "</td>
                        <td>" . "<a target='_blank' href='$url'><img src='$url' alt='$naziv' height='100px' width='100px'></a>
                        " . "</td>
                        <td>" . $red['datum_unosa'] . "</td>
                        <td><a href='uredi_namjestaj.php?" . $podaci . "'>Uredi</a></td>
                        ";
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";

            $baza->zatvoriDB();
        } else if ($_SESSION['uloga'] == 3) {
            $baza->spojiDB();

            echo "
            <h1 style='text-align:center;font-size:45px;'>Kreiraj kategoriju namještaja</h1>
            <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='kreiraj_uredi_kategoriju.php' method='GET'>
                <label for='naziv'>Naziv:</label>
                <input type='text' id='naziv' name='naziv' required><br><br>
                <label for='opis'>Opis</label>
                <input type='textarea' id='opis' name='opis' max=1000><br><br>
                <input id='kreiraj' type='submit' value='Kreiraj'>
            </form>
            ";

            $kategorije = "";
            $upit = "SELECT * FROM kategorija_namjestaja";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $kategorije = $kategorije . "<option value='" . $red['id_kategorija_namjestaja'] . "'>" . $red['naziv_kategorije'] . "</option> \n";
            }

            $korisnici = "";
            $upit = "SELECT * FROM korisnik WHERE uloga_korisnika=1 OR uloga_korisnika=2";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $korisnici = $korisnici . "<option value='" . $red['id_korisnik'] . "'>" . $red['korisnicko_ime'] . "</option> \n";
            }

            echo "
            <h1 style='text-align:center;font-size:45px;'>Dodijeli moderatora kategoriji</h1>
            <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='dodijeli_obrisi_moderatora.php' method='GET'>
                <label for='kategorija'>Kategorija:</label>
                <select id='kategorija' name='kategorija' required>
                    " . $kategorije . "
                </select><br><br>
                <label for='korisnik'>Korisnik:</label>
                <select id='korisnik' name='korisnik' required>
                    " . $korisnici . "
                </select><br><br>
                <input id='dodijeli' type='submit' value='Dodijeli'>
                <input type='hidden' id='obrisi' name='obrisi' value='ne'>
            </form>
            ";

            

            echo "<table style='margin-top:20px;margin-bottom:20px'>";
            echo "<caption class='tablica-naslov'>Kategorije namještaja</caption>";
            echo "
            <thead>
                <tr>
                    <th>Kategorija</th>
                    <th>Opis</th>
                    <th>Moderatori</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM kategorija_namjestaja";
            $odgovor = $baza->updateDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $moderatori = "";
                $naziv = "<a href='kreiraj_uredi_kategoriju.php?uredi=da&id=" . $red['id_kategorija_namjestaja'] . "&naziv=" . $red['naziv_kategorije'] . "&opis=" . $red['opis'] . "'>" . $red['naziv_kategorije'] . "</a>";
                $id = $red['id_kategorija_namjestaja'];
                $upit2 = "SELECT * FROM  moderatori_kategorije RIGHT JOIN korisnik ON moderatori_kategorije.id_korisnik=korisnik.id_korisnik WHERE id_kategorija='$id'";
                $odgovor2 = $baza->updateDB($upit2);
                while ($red2 = $odgovor2->fetch_array()) {
                    $moderatori = $moderatori . "<a href=dodijeli_obrisi_moderatora.php?obrisi=da&korisnik=".$red2['id_korisnik']."&kategorija=".$red2['id_kategorija'].">".$red2['korisnicko_ime']."</a>" . "<br>";
                }
                echo "<tr>";
                echo "
                <td>" . $naziv . "</td>
                <td>" . $red['opis'] . "</td>
                <td>" . $moderatori . "</td>
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