$(document).ready(function () {

    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Početna stranica":
            //uvjetiKoristenja();
            break;
        case "Registracija":
            registracija();
            break;
        case "Prijava":
            prijava();
            break;
        default:
            break;
    }
});

function uvjetiKoristenja() {
    var uvjetiKoristenja = "";
    if (window.confirm("Prihvaćate li uvjete korištenja?")) {
        uvjetiKoristenja = "da";

    } else {
        uvjetiKoristenja = "ne";
    }
    $.ajax({
        type: "POST",
        url: 'index.php',
        data: {
            uvjetikor: uvjetiKoristenja
        },
        success: function (data) {
            console.log(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });
}

function provjeraKorisnickogImena() {
    korime = $('#korime').val();
    if (korime != "") {
        $.ajax({
            url: 'korisnicko_ime_provjera.php',
            dataType: 'JSON',
            type: 'POST',
            data: {
                'korime': korime
            },
            cache: false,
            success: function (rezultat) {
                if (rezultat == "da") {
                    document.getElementById('korime-dostupnost').innerHTML = " Postoji";
                    document.getElementById('korime').style.border = "5px solid red";
                } else if (rezultat == "ne") {
                    document.getElementById('korime-dostupnost').innerHTML = " Ne postoji";
                    document.getElementById('korime').style.border = "5px solid green";
                }

            }
        });
    }
}

function isprazni() {
    if (document.getElementById('korime').value == "") {
        document.getElementById('korime-dostupnost').innerHTML = "";
        document.getElementById('korime').style.border = "2px solid black";
    }
}

function zaboravljenaLozinka() {
    korime = $('#korime').val();
    if (window.confirm("Jeste li sigurni da želite resetirati lozinku?")) {
        $.ajax({
            url: 'zaboravljena_lozinka.php',
            dataType: 'JSON',
            type: 'POST',
            data: {
                'korime': korime
            },
            cache: false,
            success: function (rezultat) {
                if (rezultat == 'ne') {
                    alert("Korisnik s tim korisničkim imenom ne postoji!");
                } else {
                    alert("Nova lozinka je poslana na " + rezultat);
                }
            }
        });
    }
}


function blokiraj_odblokiraj(id) {
    blokid = "blok" + id;
    statusid = "status" + id;
    brojprijavaid = "broj_prijava" + id;
    blok = document.getElementById(blokid).innerHTML;
    $.ajax({
        url: 'blokiraj_odblokiraj.php',
        dataType: 'JSON',
        type: 'POST',
        data: {
            'blok': blok,
            'id': id
        },
        cache: false,
        success: function (rezultat) {
            if (rezultat == 'Blokiraj') {
                document.getElementById(blokid).innerHTML = "Odblokiraj";
                document.getElementById(statusid).style.color = "red";
                document.getElementById(statusid).innerHTML = "Blokiran";
            } else if (rezultat == 'Odblokiraj') {
                document.getElementById(blokid).innerHTML = "Blokiraj";
                document.getElementById(statusid).style.color = "green";
                document.getElementById(statusid).innerHTML = "Aktivan";
                document.getElementById(brojprijavaid).innerHTML = "0";
            }
        }
    });
}

function naruci(idNamjestaj, idKorisnik, cijenaPopust) {
    $.ajax({
        url: 'naruci.php',
        dataType: 'JSON',
        type: 'POST',
        data: {
            'idNamjestaj': idNamjestaj,
            'idKorisnik': idKorisnik,
            'cijenaPopust': cijenaPopust
        },
        cache: false,
        success: function (rezultat) {
            if(rezultat="da")
            {
                alert("Namještaj uspješno naručen. Kreirana narudžba sa statusom 'naručen'");
            }
            else
            {
                alert("Greška pri naručivanju!");
            }
        }
    });
}

function preuzmi(idNarudzba, idKorisnik)
{
    statusid = "status" + idNarudzba;
    preuzmiid = "preuzmi" + idNarudzba;
    $.ajax({
        url: 'preuzmi.php',
        dataType: 'JSON',
        type: 'POST',
        data: {
            'idNarudzba': idNarudzba,
            'idKorisnik': idKorisnik
        },
        cache: false,
        success: function (rezultat) {
            if(rezultat="da")
            {
                alert("Namještaj uspješno preuzet.");
                document.getElementById(statusid).innerHTML = "Isporučen";
                document.getElementById(preuzmiid).innerHTML = "";
            }
            else
            {
                alert("Greška pri preuzimanju!");
            }
        }
    });
}

function narudzbeAkcija(idNarudzbe, akcija)
{
    if(akcija=="dodaj" || akcija=="azuriraj" || akcija=="kreiraj")
    {
        podaci=null;
        element = document.getElementById('input' + idNarudzbe);
        podaci = element.value;
    }
    else if(akcija=="potvrdi")
    {
        podaci=null;
    }
    if(podaci!="")
    {
        $.ajax({
            url: 'narudzbe_akcija.php',
            dataType: 'JSON',
            type: 'POST',
            data: {
                'idNarudzbe': idNarudzbe,
                'akcija': akcija,
                'podaci': podaci
            },
            cache: false,
            success: function (rezultat) {
                if(akcija=="dodaj")
                {
                    nstatus = document.getElementById('status' + idNarudzbe);
                    nstatus.innerHTML = "Dostava u tijeku";
                    form = document.getElementById('form' + idNarudzbe);
                    form.innerHTML = "<input id='input"+idNarudzbe+"' type='datetime-local' value='"+rezultat+"'> <input onclick='narudzbeAkcija("+idNarudzbe+", \"azuriraj\")' type='button' value='Ažuriraj'>";
                    ndatum = document.getElementById('datum' + idNarudzbe);
                    ndatum.innerHTML = rezultat.replace("T", " ")+":00";
                }
                else if(akcija=="azuriraj")
                {
                    nstatus = document.getElementById('status' + idNarudzbe);
                    nstatus.innerHTML = "Dostava u tijeku";
                    form = document.getElementById('form' + idNarudzbe);
                    form.innerHTML = "<input id='input"+idNarudzbe+"' type='datetime-local' value='"+rezultat+"'> <input onclick='narudzbeAkcija("+idNarudzbe+", \"azuriraj\")' type='button' value='Ažuriraj'>"
                    ndatum = document.getElementById('datum' + idNarudzbe);
                    ndatum.innerHTML = rezultat.replace("T", " ")+":00";
                }
                else if(akcija=="potvrdi")
                {
                    nstatus = document.getElementById('status' + idNarudzbe);
                    nstatus.innerHTML = "Dostava u tijeku";
                    form = document.getElementById('form' + idNarudzbe);
                    form.innerHTML = "<input id='input"+idNarudzbe+"' type='datetime-local'> <input onclick='narudzbeAkcija("+idNarudzbe+", \"dodaj\")' type='button' value='Dodaj'>";
                }
                else if(akcija=="kreiraj")
                {
                    nstatus = document.getElementById('status' + idNarudzbe);
                    nstatus.innerHTML = "Dostava u tijeku";
                    ncijena = document.getElementById('cijena' + idNarudzbe);
                    ncijena.innerHTML = podaci;
                    form = document.getElementById('form' + idNarudzbe);
                    form.innerHTML = "<input id='input"+idNarudzbe+"' type='datetime-local'> <input onclick='narudzbeAkcija("+idNarudzbe+", \"dodaj\")' type='button' value='Dodaj'>";
                }
            }
        });
    }
    else
    {
        alert("Molimo unesite potrebne podatke!")
    }
}

function registracija() {
    document.getElementById('korime').addEventListener('keyup', provjeraKorisnickogImena);
    document.getElementById('korime').addEventListener('keyup', isprazni);
}

function prijava() {
    document.getElementById('zaboravljena-lozinka').addEventListener('click', zaboravljenaLozinka);
}



