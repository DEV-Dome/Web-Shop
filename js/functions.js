
function loadMainPageUser(site) {
    $.get("pages/" + site, function (data) {
        $('#page_value').html(data);
    });
}
function loadMainPageFromACP(site) {
    $.get("acp/" + site, function (data) {
        $('#page_value').html(data);
    });
}
function loadSubMainPageFromACP(site) {
    $.get("acp/" + site, function (data) {
        $('#sub-sel').html(data);
    });
}
function loadSubPageAccount(site) {
    $.get(site, function (data) {
        $('#sub-sel').html(data);
    });
}

function DisplayArtikel(id){
    $.get("pages/Artikel.php" + "?id=" + id, function(data) {
        $('#page_value').html(data);
    });
}