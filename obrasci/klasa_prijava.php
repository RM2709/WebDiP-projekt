<?php
session_start();
$putanja = getcwd();
include_once('../baza.class.php');
include_once('../dnevnik.class.php');
$baza = new Baza();
$baza->spojiDB();
$dnevnik = new Dnevnik();
$korime = $_GET['korime'];
$lozinka = $_GET['lozinka'];

$upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korime'";
$rezultat = $baza->selectDB($upit);

if ($rezultat) {
    if ($red = $rezultat->fetch_array()) {
        $idKorisnika = $red['id_korisnik'];
        $salt = $red['salt'];
        $hashed = hash('sha256', $lozinka . $salt);
        if ($hashed == $red['lozinka_256'] && $red['status_racuna'] == 1) {
            $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava = 0 WHERE id_korisnik = $idKorisnika";
            $baza->updateDB($upit);
            $_SESSION['idKorisnika'] = $red['id_korisnik'];
            $_SESSION['korime'] = $red['korisnicko_ime'];
            $_SESSION['uloga'] = $red['uloga_korisnika'];
            $dnevnik->spremiDnevnik($_SESSION['idKorisnika'], "prijava");
        } else if ($hashed != $red['lozinka_256'] && $red['status_racuna'] == 1) {
            $loz = $red['lozinka_256'];
            $neusp = (int)$red['broj_neuspjesnih_prijava'] + 1;
            $preostalo = 5 - $neusp;
            if ($neusp != 5) {
                echo "Pogrešni korisnički podaci. \nPreostali broj pokusaja je $preostalo.";
                $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava = $neusp WHERE id_korisnik = $idKorisnika";
                $baza->updateDB($upit);
                $dnevnik->spremiDnevnik($idKorisnika, null, null, "Neuspješna prijava");
            } else {
                $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava = $neusp, status_racuna = 2 WHERE id_korisnik = $idKorisnika";
                $baza->updateDB($upit);
                echo "Račun blokiran!";
                $dnevnik->spremiDnevnik($idKorisnika, null, null, "Blokiranje računa");
            }
        } else if ($red['status_racuna'] == 2) {
            echo "Račun blokiran!";
            $dnevnik->spremiDnevnik($idKorisnika, null, null, "Pokušaj logiranja u blokiran račun");
        } else if ($red['status_racuna'] == 0) {
            echo "Račun nije aktiviran!";
            $dnevnik->spremiDnevnik($idKorisnika, null, null, "Pokušaj logiranja u neaktiviran račun");
        }
    } else {
        echo ('Ne postoji korisnik s tim korisničkim imenom');
    }
}
$baza->zatvoriDB();
