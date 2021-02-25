function login(name, password) {
    $.get("/Web-Shop/acp/php/login/Login.php?name=" + name +"&password=" + password, function(data) {
        M.toast({html: data});
        if(data.toString() == "Login"){
            location.reload();
        }
    })
}

function register(name, password, passwordw) {
    $.get("/Web-Shop/acp/php/login/Register.php?name=" + name +"&password=" + password + "&passwordw=" + passwordw, function(data) {
        M.toast({html: data});
        if(data.toString() == "Du hast dich erfolgriech Registert."){
            login(name, password);
        }
    })
}