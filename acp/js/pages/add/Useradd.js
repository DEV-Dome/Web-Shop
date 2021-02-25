$(document).ready(function(){
    $('select').formSelect();
});

function requstformula(kunde, name, password, rang){
    $.get("php/checkinpute/CheckUser.php?name=" + name.value +"&password=" + password.value + "&kunde=" + kunde.value + "&rang=" + rang.value, function(data) {
       M.toast({html: data});
        if(data.toString() == "user Angelegt"){
            loadMainPage("pages/BenutzerVerwaltung.php");
        }
    })
}
function updateformula(kunde, name, password, id, rang, acp){
	if(acp){
		 $.get("php/checkinpute/CheckUser.php?name=" + name.value +"&password=" + password.value + "&kunde=" + kunde.value + "&id=" + id + "&update=true"+ "&rang=" + rang.value, function(data) {
			M.toast({html: data});
			if(data.toString() == "user Daten geändert"){
				loadMainPage("pages/BenutzerVerwaltung.php");
			}
		})
	}else {
		$.get("acp/php/checkinpute/CheckUser.php?name=" + name +"&password=" + password.value + "&kunde=" + kunde + "&id=" + id + "&update=true"+ "&rang=" + rang, function(data) {
			M.toast({html: data});
			if(data.toString() == "user Daten geändert"){
				loadMainPage("UserDataChange.php");
			}
		})
	}

}
