<?php
session_start();
include('baza.class.php');
include('dnevnik.class.php');
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Korisnici</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za upravljanje blokiranim korisnicima">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="javascript/rmilosevi_jquery.js"></script>
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Korisnici</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <table id="tablica">
            <caption class='tablica-naslov'>Popis korisnika</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Uloga</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Korisničko ime</th>
                    <th>Email</th>
                    <th>Broj neuspješnih prijava</th>
                    <th>Status računa</th>
                    <?php
                    if ($_SESSION['uloga'] >= 3) {
                        echo "<th>Akcija</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $baza = new Baza();
                $baza->spojiDB();
                $upit = "SELECT * FROM korisnik INNER JOIN uloga_korisnika ON korisnik.uloga_korisnika=uloga_korisnika.id_uloga_korisnika";
                $akcija = "";

                $odgovor = $baza->selectDB($upit);
                if ($odgovor) {
                    while ($red = $odgovor->fetch_array()) {
                        $status = $red['status_racuna'];
                        $blokiraj = "<td><a id=blok". $red['id_korisnik'] . " class=poveznica onclick='blokiraj_odblokiraj(" . $red['id_korisnik'] . ")'>Blokiraj</a></td>";
                        $odblokiraj = "<td><a id=blok". $red['id_korisnik'] . " class=poveznica onclick='blokiraj_odblokiraj(" . $red['id_korisnik'] . ")'>Odblokiraj</a></td>";
                        switch ($status) {
                            case 0: {
                                $akcija = "<td></td>";
                                $status = "<td id=status". $red['id_korisnik'] . " style='color:beige'>Neaktivan</td>";
                                break;
                            }
                            case 1: {
                                $akcija = $blokiraj;
                                $status = "<td id=status". $red['id_korisnik'] . " style='color:green'>Aktivan</td>";
                                break;
                            }
                            case 2: {
                                $akcija = $odblokiraj;
                                $status = "<td id=status". $red['id_korisnik'] . " style='color:red'>Blokiran</td>";
                                break;
                            }
                        }
                        echo "
                    <tr>
                        <td>
                            " . $red['id_korisnik'] . "
                        </td>
                        <td>
                            " . $red['naziv'] . "
                        </td>
                        <td>
                            " . $red['ime'] . "
                        </td>
                        <td>
                            " . $red['prezime'] . "
                        </td>
                        <td>
                            " . $red['korisnicko_ime'] . "
                        </td>
                        <td>
                            " . $red['email'] . "
                        </td>
                        <td id='broj_prijava". $red['id_korisnik'] . "'>
                            " . $red['broj_neuspjesnih_prijava'] . "
                        </td>"
                            . $status
                            .
                            $akcija
                            .
                            "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
    <hr>
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>

</html>