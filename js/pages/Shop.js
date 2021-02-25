function addWarenkorb(id){
    $.get("php/addWarenkorb.php?id=" + id, function (data) {
        M.toast({html: data});
    });
}