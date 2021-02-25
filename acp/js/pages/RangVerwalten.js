function delRang(id){
    $.get("php/operation/delRang.php?id=" + id  , function(data) {
        M.toast({html: data});
        if(data.toString() == "Rang gelöscht"){
            loadMainPage("pages/RangVerwaltung.php");
        }
    })
}

function updateRang(id) {
    loadMainPage("pages/add/RangAdd.php?id=" + id);
}
function suchen(str){
    $.get("php/operation/searchRang.php?str=" + str  , function(data) {
        document.getElementById("such_output").innerHTML = data;
    })
}