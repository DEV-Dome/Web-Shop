<?php
//Ränge
$admin = false;
$user = false;

foreach ($pdo->query("SELECT * FROM rang WHERE Isdefault = 1") as $row) {
    if($row["Name"] == "Admin") $admin = true;
    if($row["Name"] == "Kunden") $user = true;
}

if(!$admin) $pdo->query("INSERT INTO rang (Name, Isdefault) VALUES ('Admin', true)");
if(!$user) $pdo->query("INSERT INTO rang (Name, Isdefault) VALUES ('Kunden', true)");

//Permission

/*Benutzer: Erstellen, Löschen, Bearbeiten, Rang Bearbeiten, Email Sehen*/
addPermission("benutzer.add", "Erstelle einen Benutzer", $pdo);
addPermission("benutzer.delete", "Lösche einen Benutzer", $pdo);
addPermission("benutzer.edit", "Bearbeite einen Benutzer", $pdo);
addPermission("benutzer.rang.edit", "Ändere den Rang eines Benutzers", $pdo);
addPermission("benutzer.mail.see", "Sehe die Mail einen Benutzers", $pdo);


/*Rang: Erstellen, Löschen, Bearbeiten*/
addPermission("rang.add", "Erstelle einen Rang", $pdo);
addPermission("rang.delete", "Lösche einen Rang", $pdo);
addPermission("rang.edit", "Bearbeite einen Rang", $pdo);

/*artikel*/
addPermission("artikel.add", "Erstelle einen artikel", $pdo);
addPermission("artikel.delete", "Lösche einen artikel", $pdo);
addPermission("artikel.edit", "Bearbeite einen artikel", $pdo);
addPermission("artikel.img.upload", "Lade ein Bild zum artikel hoch", $pdo);
addPermission("artikel.img.delete", "Lösche ein Bild zum artikel", $pdo);
addPermission("artikel.img.edit", "Bilder von artikel anzeigen ", $pdo);
addPermission("artikel.user.see", "User Dürfen Artkiel sehen", $pdo);
addPermission("artikel.user.add", "User Dürfen Artkiel erstellen", $pdo);

/*user*/
addPermission("user.add", "Erstelle einen user", $pdo);
addPermission("user.delete", "Lösche einen user", $pdo);
addPermission("user.edit", "Bearbeite einen user", $pdo);

addPermission("acp.use", "draf das ACP Benutzen", $pdo);

foreach ($pdo->query("SELECT * FROM rang_permission") as $row){
    foreach ($pdo->query("SELECT * FROM rang") as $row1){
        foreach ($pdo->query("SELECT * FROM rang_permission_syc WHERE Permission like '".$row["ID"]."' AND Rang like '".$row1["ID"]."'  LIMIT 1 ") as $row3){
            continue 2;
        }

        if($row1["ID"] == 1){
            $pdo->query("INSERT INTO rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('".$row["ID"]."', '".$row1["ID"]."', true) ");
        }else {
            $pdo->query("INSERT INTO rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('".$row["ID"]."', '".$row1["ID"]."', false) ");
        }
    }
}



function addPermission($permission, $dscribe, $pdo){
    foreach ($pdo->query("SELECT * FROM rang_permission WHERE Permission like '".$permission."' LIMIT 1 ") as $row){
        if($row["Permission"] == $permission){
            return;
        }
    }
    $pdo->query("INSERT INTO rang_permission (Permission, Dscribe) VALUES ('$permission', '$dscribe') ");
}