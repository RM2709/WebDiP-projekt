<?php
session_start();
$direktorij = getcwd();
$putanja = dirname($_SERVER['REQUEST_URI']);
$_SESSION['dosao_sa'] = "dokumentacija";
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Dokumentacija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roko Milošević">
    <meta name="description" content="Stranica s dokumentacijom projekta">
    <link href="css/rmilosevi.css" rel="stylesheet" type="text/css">
</head>

<body style="display: flex; flex-direction:column"> 
    <header id="zaglavlje">
        <span class="izbornik">
            <a href="#zaglavlje"> <img src="materijali/Menu.png" width="75" height="75" alt="Izbornik" /> </a>
        </span>
        <a href="#header-tekst">Dokumentacija</a>
        <span class="logo"> <a href="index.php"> <img src="materijali/Logo.png" width="75" height="75" alt="Logo" /> </a>
        </span>
    </header>
    <?php
    include "meni.php";
    ?>
    <hr>
    <main style="flex:1">
        <h1>Opis projektnog zadatka</h1>
        <p>Projektni zadatak je zadan sljedećim korisničkim zahtjevima: <br><br>
            Administrator<br>
            ● Kreira/Pregledava/Ažurira kategorije namještaja (kuhinjski stolovi, kreveti, kupaonski namještaj) 
            i dodjeljuje moderatore kategoriji namještaja.<br>
            ● Kreira/Pregledava/Ažurira popuste (vikend, crni petak, …) i unosi iznos popusta.<br><br>
            Moderator<br>
            ● Kreira/Pregledava/Ažurira namještaj i pridružuje ih u kategoriju namještaja za koju je
            zadužen. Za svaki namještaj unosi naziv, cijena, dimenzije namještaja
            (širinu/dužinu/visinu), boju namještaja, vrstu materijala te postavlja sliku namještaja.
            Određuje status namještaja (dostupan, kupljen).<br>
            ● Vidi popis narudžbi sa statusom dostava u tijeku. Kreira datum i vrijeme isporuke za
            narudžbu. Može ažurirati datum i vrijeme isporuke sve dok narudžba je u statusu “dostava
            u tijeku”.<br>
            ● Odabire popuste za dostupan namještaj i određuje vremensko razdoblje (od-do) trajanja
            popusta.<br>
            ● Vidi popis narudžbi namještaja i ako je narudžba sa statusom u obradi može kreirati
            namještaj. Automatski se popunjavaju sva polja i namještaj postaje kupljen. Ako je narudžba
            sa statusom naručen može potvrditi kupnju pri čemu namještaj postaje kupljen. U oba
            slučaja status narudžbe se mijenja u “dostava u tijeku”.<br>
            ● Vidi statistiku zarade kupljenog namještaja grupirano po boji i vrsti materijala.<br><br>
            Registrirani korisnik<br>
            ● Kreira/Pregledava/Ažurira narudžbu namještaja tako da odabere kategoriju namještaja i
            unosi naziv, dimenzije namještaja (širinu/dužinu/visinu), boju namještaja, vrstu
            materijala. Status narudžbe postaje u obradi.<br>
            ● Vidi popis dostupnog namještaja sa informacijom o cijeni i popustu te ga može odmah
            naručiti. Pri tome se automatski kreira narudžba koja ima status naručen.<br>
            ● Vidi sve svoje narudžbe sa statusom (u obradi, naručen, dostava u tijeku, isporučen)
            sortirane po datumu sa cijenom. Može preuzeti namještaj nakon datuma i vremena isporuke
            pri čemu se status narudžbe mijenja u isporučen.<br>
            ● Pregledava statistiku broja kupljenog namještaja grupirano po mjesecu i godini.<br><br>
            Neregistrirani korisnik<br>
            ● Vidi rang listu namještaja prema kategoriji namještaja u vremenskom razdoblju (od-do).<br>
            ● Vidi galeriju slika namještaja u kategoriji namještaja uz mogućnost sortiranja po cijeni ili
            boji te može filtrirati po popustu.<br>
        </p>
        <h1>Opis projektnog rješenja</h1>
        <p>
            Vjerujem da sam u projektnom rješenju ispunio sve zahtjeve specifične za moju temu projekta.
            U drugu ruku postoje opći zahtjevi koje nisam ispunio.
            Ostatak ovog dokumenta detaljno opisuje strukturu projektnog rješenja
        </p><br><br>
        <h1>Bitne odrednice projektnog rješenja (ERA model)</h1>
        <img src="materijali/era.png"><br><br>
        <h1>Mapa mjesta (Navigacijski dijagram)</h1>
        <img src="materijali/navigacijski.jpg"><br><br>
        <h1>Struktura</h1>
        <p>
            Datoteke su organizirane u foldere po tehnologiji ili po svrsi.<br> 
            U folderu "css" se nalazi css datoteka.<br> 
            U folderu "javascript" se nalaze javascript i jquery datoteke.<br> 
            U folderu "materijali" se nalaze slike autora, slike za logo stranice i meni, slike navigacijskog i era dijagrama<br> 
            U folderu "obrasci" se nalaze .php skripte za prijavu i registraciju te sve popratne skripte za te dvije funkcionalnosti.<br> 
            U folderu "slike" se nalaze sve slike namještaja. <br> 
            Sve ostale .php datoteke, glavne i popratne, se nalaze u glavnom direktoriju projekta.
            <br> <br> 
            Sve datoteke su opisane u sljedećoj tablici.
        </p>
        <table>
            <caption class='tablica-naslov'>Popis i opis skripti</caption>
            <thead>
                <tr>
                    <th>Skripta</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>aktiviraj.php</td>
                    <td>Služi za provjeru aktivacije korisničkog računa nakon registracije. Provjerava je li prošlo 7 sati od registracije i ovisno o tome dopušta aktivaciju ili briše račun.</td>
                </tr>
                <tr>
                    <td>klasa_prijava.php</td>
                    <td>Skripta koja sadrži poslovnu logiku prijave korisnika.</td>
                </tr>
                <tr>
                    <td>korisnicko_ime_provjera.php</td>
                    <td>Skripta koju koristi AJAX da bi provjerio dostupnost korisničkog imena u bazi.</td>
                </tr>
                <tr>
                    <td>prijava.php</td>
                    <td>Stranica prijave.</td>
                </tr>
                <tr>
                    <td>registracija.php</td>
                    <td>Stranica registracije.</td>
                </tr>
                <tr>
                    <td>zaboravljena_lozinka.php</td>
                    <td>Skripta koja dohvaća email adresu korisnika po korisničkom imenu te generira novu lozinku i šalje mail s novom lozinkom.</td>
                </tr>
                <tr>
                    <td>baza.class.php</td>
                    <td>Standardna klasa za rad s bazom.</td>
                </tr>
                <tr>
                    <td>blokiraj_odblokiraj.php</td>
                    <td>Skripta koju koristi AJAX za blokiranje/odblokiranje korisnika kod uloge administratora.</td>
                </tr>
                <tr>
                    <td>dnevnik.class.php</td>
                    <td>Skripta koja piše u dnevnik.</td>
                </tr>
                <tr>
                    <td>dnevnik.php</td>
                    <td>Stranica dnevnika.</td>
                </tr>
                <tr>
                    <td>dodijeli_obrisi_moderatora</td>
                    <td>Skripta koja sadrži logiku dodijeljivanja moderatora kategoriji i uklanjanja istog.</td>
                </tr>
                <tr>
                    <td>dokumentacija.php</td>
                    <td>Stranica dokumentacije (tj. ova stranica)</td>
                </tr>
                <tr>
                    <td>index.php</td>
                    <td>Početna stranica.</td>
                </tr>
                <tr>
                    <td>korisnici.php</td>
                    <td>Stranica s listom korisnika vidljiva ulozi administrator.</td>
                </tr>
                <tr>
                    <td>kreiraj_namjestaj.php</td>
                    <td>Skripta s poslovnom logikom za kreiranje novog namještaja i upload slike namještaja na poslužitelj.</td>
                </tr>
                <tr>
                    <td>kreiraj_uredi_kategoriju.php</td>
                    <td>Skripta koja kreira ili uređuje kategoriju namještaja. Koristi je uloga administrator.</td>
                </tr>
                <tr>
                    <td>kreiraj_uredi_popust.php</td>
                    <td>Skripta koja kreira ili uređuje popust. Koristi je uloga administrator.</td>
                </tr>
                <tr>
                    <td>meni.php</td>
                    <td>Skripta koja sadrži meni i prikazuje/skriva određene putanje za određene uloge.</td>
                </tr>
                <tr>
                    <td>namjestaj.php</td>
                    <td>Stranica namještaja.</td>
                </tr>
                <tr>
                    <td>naruci.php</td>
                    <td>Skripta koju koristi AJAX za naručivanje dostupnog namještaja.</td>
                </tr>
                <tr>
                    <td>narudzbe_akcija.php</td>
                    <td>Skripta koju koristi AJAX za upravljanje narudžbama kod uloge moderator.</td>
                </tr>
                <tr>
                    <td>o_autoru.php</td>
                    <td>Informacije o autoru.</td>
                </tr>
                <tr>
                    <td>popusti.php</td>
                    <td>Stranica s popustima.</td>
                </tr>
                <tr>
                    <td>preuzmi.php</td>
                    <td>Skripta koju koristi AJAX za preuzimanje narudžbe kod uloge registrirani korisnik.</td>
                </tr>
                <tr>
                    <td>statistika.php</td>
                    <td>Stranica sa statistikom.</td>
                </tr>
                <tr>
                    <td>upravljanje.php</td>
                    <td>Stranica s upravljanjem aplikacijom.</td>
                </tr>
                <tr>
                    <td>uredi_namjestaj_.php</td>
                    <td>Skripta koja ažurira namještaj u bazi podataka (uključujući sliku).</td>
                </tr>
                <tr>
                    <td>uredi_namjestaj.php</td>
                    <td>Stranica za uređivanje namještaja.</td>
                </tr>
                <tr>
                    <td>uredi_narudzbu.php</td>
                    <td>Stranica za uređivanje narudžbe sa skriptom za rad s bazom.</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <caption class='tablica-naslov'>Popis i opis tehnologija i alata</caption>
            <thead>
                <tr>
                    <th>Tehnologija/alat</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HTML</td>
                    <td>Jezik u kojem su izgrađene osnovne stranice.</td>
                </tr>
                <tr>
                    <td>CSS</td>
                    <td>Jezik u kojem je izrađen dizajn stranica.</td>
                </tr>
                <tr>
                    <td>Javascript</td>
                    <td>Jezik koji služi za logiku na korisničkom strani.</td>
                </tr>
                <tr>
                    <td>AJAX i Jquery</td>
                    <td>Elementi JS-a koji su korišteni na nekim mjestima na stranici za osvježavanje podataka bez osvježavanja čitave stranice.</td>
                </tr>
                <tr>
                    <td>PHP</td>
                    <td>Jezik korišten za programiranje na strani poslužitelja.</td>
                </tr>
                <tr>
                    <td>draw.io</td>
                    <td>Web alat u kojem je crtan navigacijski dijagram.</td>
                </tr>
                <tr>
                    <td>MySQL Workbench</td>
                    <td>Alat u kojem je dizajniran ERA dijagram</td>
                </tr>
                <tr>
                    <td>phpMyAdmin</td>
                    <td>Web alat u kojem je izgrađena fizička baza podataka.</td>
                </tr>
                <tr>
                    <td>XAMPP</td>
                    <td>Alat korišten za postavljanje localhost-a.</td>
                </tr>
                <tr>
                    <td>Visual Studio Code</td>
                    <td>Alat korišten za kodiranje projekta.</td>
                </tr>
                <tr>
                    <td>FileZilla</td>
                    <td>Alat koji je korišten za prijenos datoteka na poslužitelj.</td>
                </tr>
                <tr>
                    <td>Putty</td>
                    <td>Alak korišten za upravljanje datotekama na poslužitelju.</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h1>Dovršenost i greške</h1>
        <p>
            Mislim da je projekt ~70-75% dovršen i vjerujem kako nema nekih većih grešaka u izvođenju korisničkih slučajeva koji su implementirani (barem ja nisam na njih naišao kroz testiranje).
        </p>
    </main>
    <hr>
    <footer>
        <div>
            2022. &copy; Roko Milošević
        </div>
    </footer>
</body>

</html>