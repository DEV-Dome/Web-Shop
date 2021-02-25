
function loadMainPage(site){

    $.get(site, function(data) {
        $('#page_value').html(data);
    })
}