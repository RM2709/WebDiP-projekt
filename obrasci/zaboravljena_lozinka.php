<?php
include('../baza.class.php');
$korime = $_POST['korime'];
if (isset($_POST['korime'])) {
    $korime = $_POST['korime'];
    $baza = new Baza();
    $baza->spojiDB();

    $email = "";
    $upit = "SELECT * FROM korisnik";
    $rezultat = $baza->selectDB($upit)->fetch_all(MYSQLI_ASSOC);
    $postoji = false;
    foreach ($rezultat as $red) {
        if ($red['korisnicko_ime'] == $korime) {
            $postoji = true;
            $email = $red['email'];
        }
    }

    if($postoji)
    {
        $lozinka = bin2hex(random_bytes(4));
        $salt = bin2hex(random_bytes(32));
        $hash = hash('sha256', $lozinka . $salt);
        $upit = "UPDATE korisnik SET lozinka='$lozinka', salt='$salt', lozinka_256='$hash' WHERE korisnicko_ime='$korime'";
        $baza->selectDB($upit);
        $subject = 'Nova lozinka računa';
        $message = "Poštovani, za Vas smo generirali novu lozinku računa: $lozinka";
        $header = "From: no-reply@email.com";
        mail($email, $subject, nl2br($message), $header);
    
    }





    $baza->zatvoriDB();
    if ($postoji) {
        echo json_encode($email);
    } else {
        echo json_encode('ne');
    }
}
