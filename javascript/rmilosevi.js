function provjeriRegistraciju()
{
    var lozinka1 = document.getElementById("lozinka1").value;
    var lozinka2 = document.getElementById("lozinka2").value;
    var imeprez = document.getElementById("imeprez").value;
    var email = document.getElementById("email").value;

    var poljeImePrez = imeprez.split(" ");
    var poljeEmail = email.split("@");

    var greske = [false, false, false, false, false];
    var alert = "";

    if(!email.includes("@"))
    {
        alert += "Email mora sadržavati znak \"@\" !\n";
        greske[0] = true;
    }
    if(poljeEmail[0]=="" || poljeEmail[1]=="")
    {
        alert += "Email mora sadržavati znakove prije i poslije znaka \"@\" \n";
        greske[1] = true;
    }
    if(lozinka1.length < 5)
    {
        alert += "Lozinka mora biti duža od 4 znaka! \n";
        greske[2] = true;
    }
    if(lozinka1 != lozinka2)
    {
        alert += "Potvrda lozinke nije jednaka originalnom unosu! \n";
        greske[3] = true;
    }
    if(typeof imeprez[1] == 'undefined')
    {
        alert += "Molimo unesite valjano ime i prezime! \n";
        greske[4] = true;
    }

    if(alert != "")
    {
        window.alert(alert);
        event.preventDefault();
    }
}

function provjeriUnos()
{
    var slika = document.getElementById('slika').files.length;
    if(slika==0)
    {
        window.alert("Molimo Vas da unesete sliku!");
        event.preventDefault();
    }
}

function provjeriUnosPopust()
{
    odDatum = document.getElementById("od").value;
    doDatum = document.getElementById("do").value;

    if(odDatum > doDatum)
    {
        alert("Datum \"Od\" ne može biti veći od datuma \"Do\"!")
        event.preventDefault();
    }
    else if(odDatum=="" || doDatum=="")
    {
        alert("Molimo Vas da unesete vrijednosti u sva polja!")
        event.preventDefault();
    }
}

if($(document).find("title").text()=="Registracija")
{
    form = document.getElementById("potvrdi-registraciju");
    form.addEventListener("click", provjeriRegistraciju)
}

if($(document).find("title").text()=="Uredi namještaj")
{
    form = document.getElementById("spremi");
    form.addEventListener("click", provjeriUnos)
}
