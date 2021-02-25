function delArtikel(id){
    $.get("php/operation/delArtikel.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "artikel gelöscht"){
            loadMainPage("pages/ArtikelVerwaltung.php");
        }
    })
}

function updateArtikel(id) {
    loadMainPage("pages/add/ArtikelAdd.php?id=" + id);
}
function suchen(str){
    $.get("php/operation/searchArtikel.php?str=" + str  , function(data) {
        document.getElementById("such_output").innerHTML = data;
    })
}
function imgArtikel(id) {
    loadMainPage("pages/extras/ArtkielImgEdit.php?id=" + id);
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
