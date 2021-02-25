
function requstformula(name,beschreibung, preis, bestand){
    $.get("/Web-Shop/acp/php/checkinpute/CheckArtikel.php?beschreibung=" + beschreibung.value +"&preis=" + bestand.value + "&bestand=" + bestand.value + "&name=" + name.value, function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel Angelegt"){
            try{
                loadMainPage("pages/ArtikelVerwaltung.php");
            }catch (e) {
                loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
            }
        }
    })
}
function requstformulaUser(name,beschreibung, preis, bestand, id){
    $.get("/Web-Shop/acp/php/checkinpute/CheckArtikel.php?beschreibung=" + beschreibung.value +"&preis=" + bestand.value + "&bestand=" + bestand.value + "&name=" + name.value + "&usid=" + id, function(data) {
        M.toast({html: data});
        M.toast({html: "Du musst mindestens 1 Bild Hochladen, damit dein Artikel in der suche gefunden werden kann."});
        if(data.toString() == "artikel Angelegt"){
            try{
                loadMainPage("pages/ArtikelVerwaltung.php");
            }catch (e) {
                loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
            }
        }
    })
}
function updateformula(name,kunde, preis, bestand, id){
    $.get("/Web-Shop/acp/php/checkinpute/CheckArtikel.php?beschreibung=" + beschreibung.value +"&preis=" + preis.value + "&bestand=" + bestand.value + "&id=" + id + "&update=true" + "&name=" + name.value, function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel Daten geändert"){
            try{
                loadMainPage("pages/ArtikelVerwaltung.php");
            }catch (e) {
                loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
            }
        }
    })
}