<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
$_SESSION['dosao_sa'] = "dnevnik";
include_once('baza.class.php');
$baza = new Baza();
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Dnevnik</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za upravljanje dnevnikom">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
</head>

<body style="display: flex; flex-direction:column">
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Dnevnik</a>
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

        echo "
        <form class='obrazac' style='margin-top:10px;margin-bottom:0px; padding: 10px' action='dnevnik.php' method='GET'>
            <p>Pretraži po: </p>
            <label for='korisnik'>Korisniku</label>
            <input type='radio' id='korisnik' name='sort' value='korisnik'>&nbsp&nbsp
            <label for='filter'>Tipu zapisa</label>
            <input type='radio' id='tip' name='sort' value='tip'>&nbsp&nbsp
            <input type='text' id='unos' name='unos'>&nbsp&nbsp<br><br>
            <label for='od'>Od</label>
            <input type='datetime-local' id='od' name='od'>&nbsp&nbsp&nbsp
            <label for='do'>Do</label>
            <input type='datetime-local' id='do' name='do'>
            <br><br>
            <input type='submit' value='Pretraži'>
        </form>
        ";

        echo "<table style='margin-top:20px'>";
        echo "<caption class='tablica-naslov'>Dnevnik rada</caption>";
        echo "
            <thead>
                <tr>
                    <th>Korisnik</th>
                    <th>Tip zapisa</th>
                    <th>Vrijeme zapisa</th>
                    <th>Zapis</th>
                </tr>
            </thead>
            <tbody>";

        if(isset($_GET) && $_GET!=null)
        {
            if(!isset($_GET['sort']))
            {
                if($_GET['od']=="" && $_GET['do']=="")
                {
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik";
                }
                else if($_GET['od']!="" && $_GET['do']=="")
                {
                    $od = $_GET['od'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE vrijeme > '$od'";
                }
                else if($_GET['od']=="" && $_GET['do']!="")
                {
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE vrijeme < '$do'";
                }
                else if($_GET['od']!="" && $_GET['do']!="")
                {
                    $od = $_GET['od'];
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE vrijeme BETWEEN '$od' AND '$do'";
                }
            }
            else if($_GET['sort']=="korisnik")
            {
                if($_GET['od']=="" && $_GET['do']=="")
                {
                    $trazi = $_GET['unos'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE korisnicko_ime LIKE '%$trazi%'";
                }
                else if($_GET['od']!="" && $_GET['do']=="")
                {
                    $trazi = $_GET['unos'];
                    $od = $_GET['od'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE (vrijeme > '$od') AND (korisnicko_ime LIKE '%$trazi%')";
                }
                else if($_GET['od']=="" && $_GET['do']!="")
                {
                    $trazi = $_GET['unos'];
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE (vrijeme < '$do') AND (korisnicko_ime LIKE '%$trazi%')";
                }
                else if($_GET['od']!="" && $_GET['do']!="")
                {
                    $trazi = $_GET['unos'];
                    $od = $_GET['od'];
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE vrijeme BETWEEN '$od' AND '$do' AND korisnicko_ime LIKE '%$trazi%'";
                }
            }
            else if($_GET['sort']=="tip")
            {
                if($_GET['od']=="" && $_GET['do']=="")
                {
                    $trazi = $_GET['unos'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE tip LIKE '%$trazi%'";
                }
                else if($_GET['od']!="" && $_GET['do']=="")
                {
                    $trazi = $_GET['unos'];
                    $od = $_GET['od'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE (vrijeme > '$od') AND (tip LIKE '%$trazi%')";
                }
                else if($_GET['od']=="" && $_GET['do']!="")
                {
                    $trazi = $_GET['unos'];
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE (vrijeme < '$do') AND (tip LIKE '%$trazi%')";
                }
                else if($_GET['od']!="" && $_GET['do']!="")
                {
                    $trazi = $_GET['unos'];
                    $od = $_GET['od'];
                    $do = $_GET['do'];
                    $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik WHERE vrijeme BETWEEN '$od' AND '$do' AND tip LIKE '%$trazi%'";
                }
            }
        }
        else
        {
            $upit = "SELECT * FROM dnevnik_rada INNER JOIN korisnik ON dnevnik_rada.id_korisnik=korisnik.id_korisnik";
        }
        
        
        $odgovor = $baza->updateDB($upit);
        while ($red = $odgovor->fetch_array()) {
            if($red['tip']=="prijava")
            {
                $zapis = "Prijava u sustav";
            }
            if($red['tip']=="odjava")
            {
                $zapis = "Odjava iz sustava";
            }
            if($red['tip']=="upit")
            {
                $zapis = $red['upit'];
            }
            if($red['tip']=="ostalo")
            {
                $zapis = $red['radnja'];
            }
            echo "<tr>";
            echo "
                <td>" . $red['korisnicko_ime'] . "</td>
                <td>" . $red['tip'] . "</td>
                <td>" . $red['vrijeme'] . "</td>
                <td>" . $zapis . "</td>
                ";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        $baza->zatvoriDB();
        ?>
    </main>
    <hr id="hr-footer">
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>

</html>