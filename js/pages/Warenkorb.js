function deleteArtikel(id){
    $.get("php/removeWarenkorb.php?id=" + id, function (data) {
        M.toast({html: data});
        loadMainPageUser("Warenkorb.php")
    });
}
function addOneArtikel(id){
    $.get("php/addOneWarenkorb.php?id=" + id, function (data) {
        M.toast({html: data});
        loadMainPageUser("Warenkorb.php")
    });
}
function minusOneArtikel(id){
    $.get("php/minusOneWarenkorb.php?id=" + id, function (data) {
        M.toast({html: data});
        loadMainPageUser("Warenkorb.php")
    });
}
function seatchArtikel(str){
    $.get("php/searchArtikelWarenkorb.php?str=" + str, function (data) {
        document.getElementById("searchOutput").innerHTML = data;
    });
}
function kauf(id){
    $.get("php/kaufAccept.php?id=" + id, function (data) {
        if(data == "Einkauf erfolgreich"){
            loadMainPageUser('User.php?bid=' + id);
        }else {
            M.toast({html: data});
        }
    });
}