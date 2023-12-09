<?php
    include('baza.class.php');
    include_once('dnevnik.class.php');
    $dnevnik = new Dnevnik();
    $idNamjestaj = $_POST['idNamjestaj'];
    $idKorisnik = $_POST['idKorisnik'];
    $cijenaPopust = $_POST['cijenaPopust'];
    $baza = new Baza();
    $baza->spojiDB();
    $upit = "SELECT * FROM namjestaj WHERE id_namjestaj='$idNamjestaj'";
    $odgovor = $baza->selectDB($upit);
    while ($red = $odgovor->fetch_array()) {
        $cijena = $red['cijena'];
    }
    $upit = "INSERT INTO narudzba (id_namjestaj, cijena, datum_narudzbe, status_narudzbe, narucitelj) VALUES ('$idNamjestaj', '$cijenaPopust', now(), 2, '$idKorisnik')";
    $uspjeh = $baza->selectDB($upit);
    $dnevnik->spremiDnevnik($idKorisnik, null, "Naručio dostupan namještaj (id: ".$idNamjestaj.")", null);
    $baza->zatvoriDB();
    if($uspjeh)
    {
        echo json_encode('da');
    }
    else
    {
        echo json_encode('ne');
    }
    ?>