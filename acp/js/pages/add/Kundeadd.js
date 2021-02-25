function getOS() {
      var userAgent = window.navigator.userAgent,
      platform = window.navigator.platform,
      macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
      windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
      iosPlatforms = ['iPhone', 'iPad', 'iPod'],
      os = null;
 
  if (macosPlatforms.indexOf(platform) !== -1) {
    os = 'Mac OS';
  } else if (iosPlatforms.indexOf(platform) !== -1) {
    os = 'iOS';
  } else if (windowsPlatforms.indexOf(platform) !== -1) {
    os = 'Windows';
  } else if (/Android/.test(userAgent)) {
    os = 'Android';
  } else if (!os && /Linux/.test(platform)) {
    os = 'Linux';
  }
 
  return os;
}
function iniDisabledFilds(){
	document.getElementById("os").value = getOS();
}
function requstformula(name, vorname, tel, fax, adresse, hnur, plz, mail, date, bank){
    $.get("/Web-Shop/acp/php/checkinpute/CheckKunde.php?name=" + name.value +"&vorname=" + vorname.value + "&tel=" + tel.value + "&fax=" + fax.value + "&adresse=" + adresse.value + "&hnur=" +hnur.value + "&plz=" + plz.value + "&mail=" + mail.value + "&date=" + date.value + "&bank=" + bank.value  , function(data) {
        M.toast({html: data});
        if(data.toString() == "Kunde Angelegt"){
            loadMainPage("pages/KundenVerwaltung.php");
        }
    })
}
function requstformulaUser(name, vorname, tel, fax, adresse, hnur, plz, mail, date, bank, usid){
    $.get("/Web-Shop/acp/php/checkinpute/CheckKunde.php?name=" + name.value +"&vorname=" + vorname.value + "&tel=" + tel.value + "&fax=" + fax.value + "&adresse=" + adresse.value + "&hnur=" +hnur.value + "&plz=" + plz.value + "&mail=" + mail.value + "&date=" + date.value + "&bank=" + bank.value+ "&usid=" + usid  , function(data) {
        M.toast({html: data});
        if(data.toString() == "Kunde Angelegt"){
            loadMainPage("pages/KundenVerwaltung.php");
        }
    })
}

function updateformula(name, vorname, tel, fax, adresse, hnur, plz, mail, date, bank, id){
    $.get("/Web-Shop/acp/php/checkinpute/CheckKunde.php?name=" + name.value +"&vorname=" + vorname.value + "&tel=" + tel.value + "&fax=" + fax.value + "&adresse=" + adresse.value + "&hnur=" +hnur.value + "&plz=" + plz.value + "&mail=" + mail.value + "&date=" + date.value + "&bank=" + bank.value + "&id=" + id + "&update=true"  , function(data) {
        M.toast({html: data});
        if(data.toString() == "Kunden Daten geändert"){
            loadMainPage("pages/KundenVerwaltung.php");
        }
    })
}


