function delUser(id){
    $.get("php/operation/delUser.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "user gelöscht"){
            loadMainPage("pages/BenutzerVerwaltung.php");
        }
    })
}

function updateKunden(id) {
    loadMainPage("pages/add/UserAdd.php?id=" + id);
}

function suchen(str){
    $.get("php/operation/searchUser.php?str=" + str  , function(data) {
        document.getElementById("such_output").innerHTML = data;
    })
}