function delKunden(id){
    $.get("php/operation/delKunde.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "Kunde gelöscht"){
            loadMainPage("pages/KundenVerwaltung.php");
        }
    })
}

function updateKunden(id) {
    loadMainPage("pages/add/KundenAdd.php?id=" + id);
}
function suchen(str){
    $.get("php/operation/searchKunden.php?str=" + str  , function(data) {
        document.getElementById("such_output").innerHTML = data;
    })
}