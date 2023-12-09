<?php
session_start();
if($_SESSION['dosao_sa']=="aktiviraj")
{
    echo "<script>alert('Niste aktivirali račun na vrijeme. Molimo Vas da se ponovno registrirate!')</script>";
}
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
include('../baza.class.php');
include('../dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();
$prazno = [];
$polja = ['imeprez', 'email', 'korime', 'lozinka1', 'lozinka2', 'kolacici'];
$vrijednosti = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    foreach ($polja as $polje) {
        if (empty($_GET[$polje])) {
            $prazno[] = $polje;
        } else {
            $vrijednosti[$polje] = $_GET[$polje];
        }
    }
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Registracija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica za registraciju u sustav">
    <link href="../css/rmilosevi.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../javascript/rmilosevi_jquery.js"></script>
    <script src="../javascript/rmilosevi.js" defer></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="../materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Registracija</a>
        <span class="logo"> <a href="index.php"> <img src="../materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "../meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <div class="obrazac">
            <form method="get" id="obrazac-registracija" name="obrazac-registracija" action="registracija.php">
                <p>
                    <label for="imeprez">Ime i prezime: </label>
                    <input type="text" id="imeprez" name="imeprez" placeholder="Ime i prezime"><br>
                    <br><label for="email">Email adresa: </label>
                    <input type="text" id="email" name="email" size="35" placeholder=" ldap@foi.hr"><br>
                    <br><label for="korime" id="korime-label">Korisničko ime: </label>
                    <input type="text" id="korime" name="korime" size="15" placeholder="Korisničko ime" autofocus="autofocus"><span id="korime-dostupnost"></span><br>
                    <br><label for="lozinka1">Lozinka: </label>
                    <input type="password" id="lozinka1" name="lozinka1" size="15" placeholder="Lozinka"><br>
                    <br><label for="lozinka2">Ponovi pozinku: </label>
                    <input type="password" id="lozinka2" name="lozinka2" size="15" placeholder="Lozinka"><br>
                    <br><label for="kolacici">Odaberi kolačiće: </label>
                    <select id="kolacici" name='kolacici[]' multiple>
                        <option value="sortiranje">Kolačić sortiranja (Zapamti redoslijed sortiranja)</option>
                        <option value="pretraga">Kolačić pretraživanja(Zapamti poslijednje pretraživanje)</option>
                        <option value="adresa">Kolačić adrese (Unaprijed popuni adresu pri kreiranju narudžbe)</option>
                    </select><br>
                <!--<div class="g-recaptcha" data-sitekey="6LckuFcgAAAAAAEtbckrfsMsG3dXoNBJW7DZ6VbC"></div><br>-->
            </form>
            <input id="potvrdi-registraciju" type="submit" value=" Registriraj se " form="obrazac-registracija">
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
if ($_SESSION['dosao_sa'] == "registracija") {
    if (empty($prazno)) {
        /*
        //CAPTCHA
        function post_captcha($user_response)
        {
            $fields_string = '';
            $fields = array(
                'secret' => '6LckuFcgAAAAAHgy3ViQF4l_ksw1kFzsZSL7095u',
                'response' => $user_response
            );
            foreach ($fields as $key => $value)
                $fields_string .= $key . '=' . $value . '&';
            $fields_string = rtrim($fields_string, '&');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }
        $captcha = post_captcha($_GET['g-recaptcha-response']);
        */
        $imeiprezime = $_GET['imeprez'];
        $email = $_GET['email'];
        $korime = $_GET['korime'];
        $lozinka1 = $_GET['lozinka1'];
        $lozinka2 = $_GET['lozinka2'];
        $kolacici = $_GET['kolacici'];
        $sortiranje = NULL;
        $pretraga = NULL;
        $adresa = NULL;
        foreach ($kolacici as $kolacic) {
            switch ($kolacic) {
                case "sortiranje":
                    $sortiranje = true;
                    break;
                case "pretraga":
                    $pretraga = 1;
                    break;
                case "adresa":
                    $adresa = 1;
                    break;
            }
        }
        $upit = "select * from korisnik";
        $rezultat = $baza->selectDB($upit)->fetch_all(MYSQLI_ASSOC);
        $postoji = false;
        foreach ($rezultat as $red) {
            if ($red['korisnicko_ime'] == $korime) {
                $postoji = true;
            }
        }

        $imeprez = explode(" ", $imeiprezime);
        $emaildio = explode("@", $email);

        $alert = "";

        // VALIDACIJA POSLUZITELJ
        if ($postoji) {
            $alert = $alert . "Korisnik s odabranim korisničkim imenom već postoji! \\n";
        }
        if (!str_contains($email, "@")) {
            $alert = $alert . "Email mora sadržavati znak \"@\" ! \\n";
        }
        if ($emaildio[1] == "" || $emaildio[0] == "") {
            $alert = $alert . "Email mora sadržavati znakove prije i poslije znaka \"@\" ! \\n";
        }
        if (strlen($lozinka1) < 5) {
            $alert = $alert . "Lozinka mora biti duža od 4 znaka! \\n";
        }
        if ($lozinka1 != $lozinka2) {
            $alert = $alert . "Potvrda lozinke nije jednaka originalnom unosu! \\n";
        }
        if (!isset($imeprez[1])) {
            $alert = $alert . "Molimo unesite valjano ime i prezime! \\n";
        }
        /*
        if (!$captcha['success']) {
            $alert = $alert . "Molimo potvrdite da niste robot putem Google reCAPTCHA! \\n";
        }
        */
        if (strcmp($alert, "") != 0) {
            echo "<script> alert('$alert') </script>";
            exit();
        }

        $salt = bin2hex(random_bytes(32));
        $hash = hash('sha256', $lozinka1 . $salt);

        $aktivacijski_kod = bin2hex(random_bytes(16));

        $upit = "INSERT INTO korisnik (id_korisnik, uloga_korisnika, ime, prezime, korisnicko_ime, lozinka, salt, lozinka_256, email, broj_neuspjesnih_prijava, uvjeti_koristenja, status_racuna, datum_registracije, aktivacijski_kod, sortiranje, pretraga, adresa) 
         VALUES (default, 1, '$imeprez[0]', '$imeprez[1]', '$korime', '$lozinka1', '$salt', '$hash', '$email', 0, now(), 0, now(), '$aktivacijski_kod', '$sortiranje', '$pretraga', '$adresa')";

        $baza->updateDB($upit);

        $upit = "SELECT id_korisnik FROM korisnik WHERE korisnicko_ime='$korime'";
        $rezultat = $baza->selectDB($upit);
        if($red = $rezultat->fetch_array()) {
            $id = $red['id_korisnik'];
        }
        $dnevnik->spremiDnevnik($id, null, null, "Registracija");
        
        // EMAIL AKTIVACIJA
        //LOCALHOST
        //$activation_link = "http://localhost/webdip_projekt/obrasci/aktiviraj.php?email=$email&kod=$aktivacijski_kod";
        //BARKA
        $activation_link = "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x075/obrasci/aktiviraj.php?email=$email&kod=$aktivacijski_kod";
        $subject = 'Aktivacija računa';
        $message = "Poštovani, molimo Vas da klikom na sljedeći link aktivirate vaš račun: $activation_link";
        $header = "From: no-reply@email.com";
        mail($email, $subject, nl2br($message), $header);

        exit();
    } else {
        echo "<script> alert('Molimo unesite sve podatke!') </script>";
    }
}
$baza->zatvoriDB();
$_SESSION['dosao_sa'] = "registracija";
?>