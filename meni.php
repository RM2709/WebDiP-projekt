<?php

echo "<nav><ul>";

if (isset($_SESSION['uloga'])) {
    echo  "<li><a href=\"$putanja/obrasci/prijava.php\">Odjava</a></li>";
} else {
    echo  "<li><a href=\"$putanja/obrasci/prijava.php\">Prijava</a></li>";
}

echo  "<li><a href=\"$putanja/index.php\">Početna stranica</a></li>";
echo  "<li><a href=\"$putanja/o_autoru.php\">O autoru</a></li>";
echo  "<li><a href=\"$putanja/dokumentacija.php\">Dokumentacija</a></li>";
echo  "<li><a href=\"$putanja/namjestaj.php\">Namještaj</a></li>";

if (!isset($_SESSION['uloga'])) {
    echo  "<li><a href=\"$putanja/obrasci/registracija.php\">Registracija</a></li>";
}

if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 1) {
    echo  "<li><a href=\"$putanja/narudzbe.php\">Narudžbe</a></li>";
    echo  "<li><a href=\"$putanja/statistika.php\">Statistika</a></li>";
}

if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 2) {
    echo  "<li><a href=\"$putanja/popusti.php\">Popusti</a></li>";
}

if (isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 3) {
    echo  "<li><a href=\"$putanja/upravljanje.php\">Upravljanje aplikacijom</a></li>";
    echo  "<li><a href=\"$putanja/korisnici.php\">Korisnici</a></li>";
    echo  "<li><a href=\"$putanja/dnevnik.php\">Dnevnik</a></li>";
}

echo "</ul></nav>";

