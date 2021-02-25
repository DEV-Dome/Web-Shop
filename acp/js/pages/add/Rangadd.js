function addRang(name, beschreibung){
    var permission = document.getElementsByName("permission");
    var reg = "";

    for(var i = 0; i < permission.length; i++) {
        if(permission[i].checked){
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":yes";
            }else{
                reg += "&perm[]=" + permission[i].id + ":yes";
            }
        }else {
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":no";
            }else{
                reg += "&perm[]=" + permission[i].id + ":no";
            }

        }
    }

    $.get("php/checkinpute/CheckRang.php?beschreibung=" + beschreibung.value +"&name=" + name.value + "&" + reg, function(data) {
        M.toast({html: data});
        if(data.toString() == "Rang Angelegt"){
            loadMainPage("pages/RangVerwaltung.php");
        }
    })


}

function updateformula(name, beschreibung, id){
    var permission = document.getElementsByName("permission");
    var reg = "";

    for(var i = 0; i < permission.length; i++) {
        if(permission[i].checked){
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":yes";
            }else{
                reg += "&perm[]=" + permission[i].id + ":yes";
            }
        }else {
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":no";
            }else{
                reg += "&perm[]=" + permission[i].id + ":no";
            }

        }
    }

    $.get("php/checkinpute/CheckRang.php?beschreibung=" + beschreibung.value +"&name=" + name.value + "&" + "id=" + id + "&update=true&" +reg, function(data) {
        M.toast({html: data});
        if(data.toString() == "Rang Daten geändert"){
            loadMainPage("pages/RangVerwaltung.php");
        }
    })
}