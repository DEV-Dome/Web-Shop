M.AutoInit();

function sendImg(valueimg, id){

    var reader = new FileReader();
    reader.readAsDataURL(valueimg);
    reader.onloadend = function() {
        console.log(reader.result);
        var values = "&id="+ id +"&img=" + (reader.result.split("+").join("."));
        console.log(reader.result.split("+").join("."))
        $.ajax({
            type: "POST",
            url: "/Web-Shop/acp/php/checkinpute/CheckImg.php",
            data: values,
            success: function (response) {
                M.toast({html: response});
                if(response.toString() == "artikel Bild Angelegt"){
                    try{
                        loadMainPage("pages/ArtikelVerwaltung.php");
                    }catch (e) {
                        loadSubPageAccount("pages/user/UserArtikelVerwalten.php");
                    }
                }
            }
        });
    }


}

