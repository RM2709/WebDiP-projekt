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
    <title>Popusti</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za upravljanje popustima">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="javascript/rmilosevi.js" defer></script>
</head>

<body style="display: flex; flex-direction:column">
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Popusti</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <?php
        $baza->spojiDB();
        if(isset($_GET['namjestaj']))
        {
            $popust = $_GET['popust'];
            $namjestaj = $_GET['namjestaj'];
            $od = $_GET['od'];
            $do = $_GET['do'];
            $upit = "INSERT INTO popust_namjestaja (id_popust, id_namjestaja, traje_od, traje_do) VALUES
            ('$popust', '$namjestaj', '$od', '$do')";
            $odgovor = $baza->selectDB($upit);
            $dnevnik->spremiDnevnik($idKorisnika, null, "Odabir popusta (id: ".$popust.") za namještaj (id: ".$namjestaj.")", null);
            header("Location: popusti.php");
        }

        
        $upit = "SELECT * FROM moderatori_kategorije INNER JOIN kategorija_namjestaja ON moderatori_kategorije.id_kategorija=kategorija_namjestaja.id_kategorija_namjestaja WHERE id_korisnik='$idKorisnika'";
        $odgovor = $baza->selectDB($upit);
        while ($red = $odgovor->fetch_array()) {
            $idKategorije = $red['id_kategorija'];
            $nazivKategorije = $red['naziv_kategorije'];
        }
        if ($_SESSION['uloga'] == 2) {
            $namjestaj = "";
            $upit = "SELECT * FROM namjestaj WHERE kategorija_namjestaja='$idKategorije'";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $namjestaj = $namjestaj . "<option value='" . $red['id_namjestaj'] . "'>" . $red['naziv'] . "</option> \n";
            }
            $popusti = "";
            $upit = "SELECT * FROM popust";
            $odgovor = $baza->selectDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $popusti = $popusti . "<option value='" . $red['id_popust'] . "'>" . $red['naziv_popusta'] . " (".($red['iznos']*100)."%)</option> \n";
            }
            echo "
            <h1 style='text-align:center;font-size:45px;'>Odaberi popust</h1>
            <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='popusti.php' method='GET'>
                <label for='namjestaj'>Namještaj:</label>
                <select id='namjestaj' name='namjestaj' required>
                ".$namjestaj."
                </select><br><br>
                <label for='popust'>Popust:</label>
                <select id='popust' name='popust' required>
                ".$popusti."
                </select><br><br>
                <label for='od'>Od</label>
                <input type='datetime-local' id='od' name='od'><br><br>
                <label for='do'>Do</label>
                <input type='datetime-local' id='do' name='do'><br><br>
                <input id='odaberi' onclick='provjeriUnosPopust()' type='submit' value='Odaberi'>
            </form>
            ";

            echo "<table style='margin-top:20px'>";
            echo "<caption class='tablica-naslov'>Popusti</caption>";
            echo "
            <thead>
                <tr>
                    <th>Namještaj</th>
                    <th>Popust</th>
                    <th>Iznos popusta</th>
                    <th>Od</th>
                    <th>Do</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM popust INNER JOIN popust_namjestaja ON popust.id_popust=popust_namjestaja.id_popust INNER JOIN namjestaj ON popust_namjestaja.id_namjestaja=namjestaj.id_namjestaj WHERE namjestaj.kategorija_namjestaja='$idKategorije'";
            $odgovor = $baza->updateDB($upit);
            while ($red = $odgovor->fetch_array()) {
                echo "<tr>";
                echo "
                <td>" . $red['naziv'] . "</td>
                <td>" . $red['naziv_popusta'] . "</td>
                <td>" . ($red['iznos'] * 100) . "%</td>
                <td>" . $red['traje_od'] . "</td>
                <td>" . $red['traje_do'] . "</td>
                ";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        if ($_SESSION['uloga'] == 3) {
            echo "
            <h1 style='text-align:center;font-size:45px;'>Kreiraj popust</h1>
            <form class='obrazac' style='text-align:center;padding:20px;margin-top:0px' action='kreiraj_uredi_popust.php' method='GET'>
                <label for='naziv'>Naziv:</label>
                <input type='text' id='naziv' name='naziv' required><br><br>
                <label for='iznos'>Iznos (decimalno):</label>
                <input type='number' id='iznos' name='iznos' required min='0' max='1' step='0.01'><br><br>
                <label for='opis'>Opis</label>
                <input type='textarea' id='opis' name='opis' max=1000><br><br>
                <input id='kreiraj' type='submit' value='Kreiraj'>
            </form>
            ";

            echo "<table style='margin-top:20px;margin-bottom:20px'>";
            echo "<caption class='tablica-naslov'>Popusti</caption>";
            echo "
            <thead>
                <tr>
                    <th>Popust</th>
                    <th>Iznos</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody>
            ";
            $upit = "SELECT * FROM popust";
            $odgovor = $baza->updateDB($upit);
            while ($red = $odgovor->fetch_array()) {
                $naziv = "<a href='kreiraj_uredi_popust.php?uredi=da&id=".$red['id_popust']."&naziv=".$red['naziv_popusta']."&iznos=".$red['iznos']."&opis=".$red['opis']."'>".$red['naziv_popusta']."</a>";
                echo "<tr>";
                echo "
                <td>" . $naziv . "</td>
                <td>" . ($red['iznos'] * 100) . "%</td>
                <td>" . $red['opis'] . "</td>
                ";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        $baza->zatvoriDB();
        $_SESSION['dosao_sa'] = "popusti";
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