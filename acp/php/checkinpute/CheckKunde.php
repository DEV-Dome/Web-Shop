<?php
include "../obj.php";
include "../security/XSS.php";
$ErrorHandler = new ErrorObj("Eingabe-Fehler");
//update
$update = false;
if(isset($_GET["update"])){
$update = true;
$id = $_GET["id"];
}
if(isset($_GET["usid"])){
	$usid = $_GET["usid"];
}else {
	$usid = null;
}

// ----------------------- Vorname -------------------------------- //

//Keine zahlen, Alles kein, nur Nur der Erste Buchstabe große, Minimal 3 zeichen,Maximal 100 zeichen;
$vorname = xss_clean($_GET["vorname"]);

//prüfe ob der Vorname Eingeben wurde 
if(isset($_GET["vorname"])){
	//schleifenvariablen
    $temp = str_split($vorname);
	$max = sizeof($temp);
	
	//cannel variablen der schleife
	$isnumber = false;
	$isBig = false;
	$isempty = false;
	
	//schleife geht jeden buchstaben der benutzereinageb "vorname" durch
	for($i = 0; $i < $max; $i++){
		//prüfe ob der Erste buchstabe von Vornamen Groß geschrieben ist!
		if($i == 0 && !ctype_upper($temp[$i])){
			$ErrorHandler->addError("Im Vornamen muss der erste Buchstabe großegeschreiben seinen!");
		}
		//prüfe ob der nur Erste buchstabe von Vornamen Groß geschrieben ist!
		if($i != 0 && ctype_upper($temp[$i]) && !$isBig){
			$ErrorHandler->addError("Im Vornamen darf nur der erste Buchstabe großegeschreiben seinen!");
			$isBig = true;
		}
		//prüfe ob der Vorname keine Ziffern hat
		if(is_numeric($temp[$i]) && !$isnumber){
			$ErrorHandler->addError("Der Vorname darf keine Zeichen enthalten!");
			$isnumber = true;
		}
		//prüfe ob keine leerzeichen vorhanden sind
		if($temp[$i] == " " && !$isempty){
			$ErrorHandler->addError("Im Vornamen dürfen keine leer Zeichen seinen!");
			$isempty = true;
		}
	}

	//min. 3 zeichen
	if($max <= 2){
		$ErrorHandler->addError("Der Vorname, muss min. 3 Zeichen lang seinen!");
	}
	
	//max. 100 zeichen
	if($max >= 100){
		$ErrorHandler->addError("Der Vorname, darf max. 100 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss einen Vornamen eingeben werden!");
}

// ----------------------- Nachname -------------------------------- //

//Keine zahlen, Minimal 3 zeichen,Maximal 100 zeichen
$name = xss_clean($_GET["name"]);

if(isset($_GET["name"])){
	//schleifenvariablen
    $temp = str_split($name);
	$max = sizeof($temp);

	//schleife geht jeden buchstaben der benutzereinageb "name" durch
	for($i = 0; $i < $max; $i++){
		//prüfe ob der Vorname keine Ziffern hat
		if(is_numeric($temp[$i])){
			$ErrorHandler->addError("Der Nachname darf keine Zeichen enthalten!");
			break;
		}
	}

	//min. 3 zeichen
	if($max <= 2){
		$ErrorHandler->addError("Der Nachname, muss min. 3 Zeichen lang seinen!");
	}
	
	//max. 100 zeichen
	if($max >= 100){
		$ErrorHandler->addError("Der Nachname, darf max. 100 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss einen Nachname eingeben werden!");
}

// ----------------------- Telefonnummer -------------------------------- //

//nur ziffern; kürzeste telefonnummmer 6 Zeichen längste 21;
$tel = xss_clean($_GET["tel"]);

if(isset($_GET["tel"])){
	//schleifenvariablen
    $temp = str_split($tel);
	$max = sizeof($temp);

	//cannel variablen der schleife
	$isnumber = false;
	$isempty = false;
	
	//schleife geht jeden buchstaben der benutzereinageb "tel" durch
	for($i = 0; $i < $max; $i++){
		//prüfe ob Die Telefonnummer nur Ziffern hat
		if(!is_numeric($temp[$i]) && !$isnumber){
			$ErrorHandler->addError("Die Telefonnummer darf nur ziffern enthalten!");
			$isnumber = true;
		}
		if($temp[$i] == "" && !$isempty){
			$ErrorHandler->addError("Die Telefonnummer darf keine leerzeichen enthalten!");
			$isempty = true;
		}
	}
	//min. 5 zeichen
	if($max <= 5){
		$ErrorHandler->addError("Die Telefonnummer, muss min. 6 Zeichen lang seinen!");
	}
	
	//max. 21 zeichen
	if($max >= 21){
		$ErrorHandler->addError("Die Telefonnummer, darf max. 21 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss eine Telefonnummer eingeben werden!");
}

// ----------------------- Faxnummer -------------------------------- //

//nur ziffern; kürzeste telefonnummmer 6 Zeichen längste 21;
$fax = xss_clean($_GET["fax"]);

if(isset($_GET["fax"])){
	//schleifenvariablen
    $temp = str_split($fax);
	$max = sizeof($temp);

	//cannel variablen der schleife
	$isnumber = false;
	$isempty = false;
	
	//schleife geht jeden buchstaben der benutzereinageb "tel" durch
	for($i = 0; $i < $max; $i++){
		//prüfe ob Die Telefonnummer nur Ziffern hat
		if(!is_numeric($temp[$i]) && !$isnumber){
			$ErrorHandler->addError("Die Faxfonnummer darf nur ziffern enthalten!");
			$isnumber = true;
		}
		if($temp[$i] == "" && !$isempty){
			$ErrorHandler->addError("Die Faxfonnummer darf keine leerzeichen enthalten!");
			$isempty = true;
		}
	}
	//min. 5 zeichen
	if($max <= 5){
		$ErrorHandler->addError("Die Faxfonnummer, muss min. 6 Zeichen lang seinen!");
	}
	
	//max. 21 zeichen
	if($max >= 21){
		$ErrorHandler->addError("Die Faxfonnummer, darf max. 21 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss eine Faxfonnummer eingeben werden!");
}

// ----------------------- Starße -------------------------------- //

//nur buchstaben, min 3, max 100;
$adresse = xss_clean($_GET["adresse"]);

if(isset($_GET["adresse"])){
	//schleifenvariablen
    $temp = str_split($adresse);
	$max = sizeof($temp);
	
	for($i = 0; $i < $max; $i++){
		//prüfe ob Die Telefonnummer nur Ziffern hat
		if(is_numeric($temp[$i])){
			$ErrorHandler->addError("Die Straße darf nur Buchstaben enthalten!");
			break;
		}

	}

	//min. 3 zeichen	
	if($max <= 2){
		$ErrorHandler->addError("Die Starße, muss min. 3 Zeichen lang seinen!");
	}
	
	//max. 100 zeichen
	if($max >= 100){
		$ErrorHandler->addError("Die Starße, darf max. 100 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss eine Starße eingeben werden!");
}

// ----------------------- Hausnummer -------------------------------- //

//min 1, max 10;
$hnur = xss_clean($_GET["hnur"]);

if(isset($_GET["hnur"])){
	//schleifenvariablen
    $temp = str_split($hnur);
	$max = sizeof($temp);

	//min. 1 zeichen	
	if($max <= 1){
		$ErrorHandler->addError("Die eine Hausnummer, muss min. 1 Zeichen lang seinen!");
	}
	
	//max. 10 zeichen
	if($max >= 10){
		$ErrorHandler->addError("Die eine Hausnummer, darf max. 10 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss eine Hausnummer eingeben werden!");
}

// ----------------------- PLZ -------------------------------- //

//nur zahlen genau 5 zeichen
$plz = xss_clean($_GET["plz"]);

if(isset($_GET["plz"])){
	//schleifenvariablen
    $temp = str_split($plz);
	$max = sizeof($temp);
	
	for($i = 0; $i < $max; $i++){
		//prüfe ob Die Telefonnummer nur Ziffern hat
		if(!is_numeric($temp[$i])){
			$ErrorHandler->addError("Die Postleitzahl darf nur ziffern enthalten!");
			break;
		}

	}

	//genau 5 zeichen 
	if($max != 5){
		$ErrorHandler->addError("Die Postleitzahl, muss 5 Zeichen haben!");
	}
}else {
	$ErrorHandler->addError("Es muss eine Postleitzahl eingeben werden!");
}

// ----------------------- Email -------------------------------- //
//muss @ und . enthalten.
$mail = xss_clean($_GET["mail"]);

if(isset($_GET["mail"])){
	//schleifenvariablen
	$temp = str_split($mail);
	$max = sizeof($temp);
	
	
	//min. 3 zeichen	
	if($max <= 2){
		$ErrorHandler->addError("Die E-mail, muss min. 3 Zeichen lang seinen!");
	}
	
	//max. 100 zeichen
	if($max >= 100){
		$ErrorHandler->addError("Die E-mail, darf max. 100 Zeichen lang seinen!");
	}
}else {
	$ErrorHandler->addError("Es muss eine E-mail eingeben werden!");
}

// ----------------------- Date -------------------------------- //
$date = $_GET["date"];

if(!isset($_GET["date"])){
	$ErrorHandler->addError("Du musst einen Datum angeben!");
}

// ----------------------- Bank -------------------------------- //
$bank = xss_clean($_GET["bank"]);
$temp = str_split($bank);
$max = sizeof($temp);

	if(!($max <= 1)){
		if(!test_iban($bank)){
		$ErrorHandler->addError("Du hast eine falsche Iban eingeben!");
		}
	}else {
		$ErrorHandler->addError("Du hast eine falsche Iban eingeben!");
	}

//Admin artikel = Im Admininterface angelegt; = system
if($usid == null) {
	echo $ErrorHandler->giveErro();
	if($ErrorHandler->isNoError()){
		include "../sql/Sql.php";
		if($update){
			$pdo->query("UPDATE adresse SET vorname='$vorname',nachname='$name',tefonnummer='$tel',faxnummer='$fax',starsse='$adresse',hausnnumer='$hnur',plz='$plz',email='$mail',geburtstag='$date',iban='$bank' WHERE ID =". $id);
			echo "Kunden Daten geändert";
			exit();
		}
		$pdo->query("INSERT INTO adresse (vorname,nachname,tefonnummer,faxnummer,starsse,hausnnumer,plz,email,geburtstag,iban) VALUES ('$vorname', '$name', '$tel', '$fax', '$adresse', '$hnur', '$plz', '$mail', '$date', '$bank')");
		echo "Kunde Angelegt";
	}
}else {
	//User anlage
	echo $ErrorHandler->giveErro();
	if($ErrorHandler->isNoError()){
		include "../sql/Sql.php";
		$pdo->query("INSERT INTO adresse (vorname,nachname,tefonnummer,faxnummer,starsse,hausnnumer,plz,email,geburtstag,iban) VALUES ('$vorname', '$name', '$tel', '$fax', '$adresse', '$hnur', '$plz', '$mail', '$date', '$bank')");

		foreach ($pdo->query("SELECT * FROM adresse WHERE vorname = '". $vorname . "' AND nachname = '". $name . "' AND email = '". $mail . "' AND iban = '$bank'") as $row) {
			$newID = $row["ID"];
		}

		$pdo->query("UPDATE user SET Kunde = $newID WHERE ID = $usid");
		echo "Deinen Daten wurden angelegt.";
	}
}

?>
