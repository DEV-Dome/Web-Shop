<?php
include "Sql.php";

$pdo->query("CREATE TABLE IF NOT EXISTS rang(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(100) NOT NULL,
Dscribe TEXT(500),
Isdefault bool NOT NULL
)");

$pdo->query("CREATE TABLE IF NOT EXISTS adresse(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
vorname VARCHAR(100) NOT NULL,
nachname VARCHAR(100) NOT NULL,
tefonnummer INT(26) NOT NULL,
faxnummer INT(26) NOT NULL,
starsse VARCHAR(100) NOT NULL,
hausnnumer VARCHAR(10) NOT NULL,
plz VARCHAR(5) NOT NULL,
email VARCHAR(100) NOT NULL,
geburtstag VARCHAR(15) NOT NULL,
iban VARCHAR(100) NOT NULL
)");

$pdo->query("CREATE TABLE IF NOT EXISTS user(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Username VARCHAR(100) NOT NULL,
Password VARCHAR(512) NOT NULL, 
Kunde int(10),
Rang int(10),

FOREIGN KEY (Kunde) REFERENCES adresse(ID),
FOREIGN KEY (Rang) REFERENCES rang(ID)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS artikel (
  artikelnr INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  beschreibung VARCHAR(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  preis DECIMAL(6,2) DEFAULT NULL,
  bestand INT(5) DEFAULT NULL,
  Owner int(10),
  
  FOREIGN KEY (Owner) REFERENCES user(ID)
)");
$pdo->query("CREATE TABLE IF NOT EXISTS artikel_img (
  imgnr INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  artikelnr INT(11),
  img BLOB,
  is_first BOOLEAN,
  
  FOREIGN KEY (artikelnr) REFERENCES artikel(artikelnr)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS user_img(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
img BLOB,
is_main BOOLEAN,

FOREIGN KEY (ID) REFERENCES user(ID)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS rang_permission(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission VARCHAR(100) NOT NULL,
Dscribe TEXT(500)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS rang_permission_syc(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission int(10) NOT NULL,
Rang  int(10) NOT NULL,
Haspermission BOOL NOT NULL,

FOREIGN KEY (Permission) REFERENCES rang_permission(ID),
FOREIGN KEY (Rang) REFERENCES rang(ID)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS bestellungen(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user int(10) NOT NULL,
sendeverfolung VARCHAR(100),
rechnung BLOB,

FOREIGN KEY (user) REFERENCES user(ID)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS warenkorb_arikel_syc(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
bestellungesid int(10) NOT NULL,
artikel int(10) NOT NULL,
menge int(10) NOT NULL,

FOREIGN KEY (artikel) REFERENCES artikel(artikelnr),
FOREIGN KEY (bestellungesid) REFERENCES bestellungen(ID)
)");


