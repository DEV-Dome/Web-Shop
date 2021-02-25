function logout(acp) {
    if(acp){
        $.get("php/login/Logout.php", function (data) {
            M.toast({html: data});
            if (data.toString() == "Erfolgrich ausgeloggt!") {
                location.reload();
            }
        })
    }else {
        $.get("acp/php/login/Logout.php", function (data) {
            M.toast({html: data});
            if (data.toString() == "Erfolgrich ausgeloggt!") {
                location.reload();
            }
        })
    }

}