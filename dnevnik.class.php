<?php
include_once('baza.class.php');
class Dnevnik
{

    public function spremiDnevnik($idKorisnik, $prijavaOdjava = null, $upit = null, $radnja = null)
    {
        $baza = new Baza();
        $baza->spojiDB();
        if($upit==null && $radnja!=null)
        {
            $query = "INSERT INTO dnevnik_rada (id_korisnik, tip, vrijeme, radnja) VALUES ('$idKorisnik', 'ostalo', now(), '$radnja')";
        }
        else if($upit!=null && $radnja==null)
        {
            $query = "INSERT INTO dnevnik_rada (id_korisnik, tip, vrijeme, upit) VALUES ('$idKorisnik', 'upit', now(), '$upit')";
        }
        else if($upit==null && $radnja==null)
        {
            $query = "INSERT INTO dnevnik_rada (id_korisnik, tip, vrijeme) VALUES ('$idKorisnik', '$prijavaOdjava', now())";
        }
        $baza->updateDB($query);
        $baza->zatvoriDB();
    }

    public function citajDnevnik()
    {
    }
}
?>