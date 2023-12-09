<?php
    include('baza.class.php');
    $id = $_POST['id'];
    $blok = $_POST['blok'];
    $baza = new Baza();
    $baza->spojiDB();
    if($blok=="Blokiraj")
    {
        $upit = "UPDATE korisnik SET status_racuna='2' WHERE id_korisnik='$id'";
    }
    else if($blok=="Odblokiraj")
    {
        $upit = "UPDATE korisnik SET status_racuna='1', broj_neuspjesnih_prijava='0' WHERE id_korisnik='$id'";
    }
    $baza->selectDB($upit);
    echo json_encode($blok);
?>