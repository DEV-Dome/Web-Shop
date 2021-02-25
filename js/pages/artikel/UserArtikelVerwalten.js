
function delArtikel(id){
    $.get("acp/php/operation/delArtikel.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel gelöscht"){
            loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
        }
    })
}

function updateArtikel(id) {
    loadMainPageFromACP("pages/add/ArtikelAdd.php?id=" + id);
}
function suchen(str){
    $.get("pages/user/Artikel/SearchArikel.php?str=" + str  , function(data) {
        document.getElementById("such_output").innerHTML = data;
    })
}
function imgArtikel(id) {
    loadSubPageAccount("pages/user/Artikel/UserArtikelImgEdit.php?id=" + id);
}
function delImgArtikel(id){
    $.get("/Web-Shop/acp/php/operation/delArtikelImg.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel Bild gelöscht"){
            try{
                loadMainPage("pages/ArtikelVerwaltung.php");
            }catch (e) {
                loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
            }
        }
    })
}
function ChangeImgArtikel(id, pid) {
    $.get("/Web-Shop/acp/php/operation/ChangeArtikelImg.php?id=" + id + "&pid=" + pid  , function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel Bild geändert"){
            try{
                loadMainPage("pages/ArtikelVerwaltung.php");
            }catch (e) {
                loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
            }
        }
    })
}