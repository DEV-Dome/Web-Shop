<?php

class Rang
{
    public $permission;
    private $rangid;

    private $noperm = true;

    function __construct1() {

    }
    function __construct($rangid, $pdo) {
       if($rangid == -1){
           $this->permission = array();
           $this->rangid = -1;
           $this->noperm = true;
           return;
       }

        $this->permission = array();
        $this->rangid = $rangid;

        $this->loadPermission($pdo);
    }


    function loadPermission($pdo){
        if($this->rangid == -1) return;

        if (!empty($pdo)) {
            foreach($pdo->query("SELECT * FROM rang_permission_syc WHERE Rang like $this->rangid AND Haspermission like true") as $row) {
                $id = $row['Permission'];
                foreach($pdo->query("SELECT * FROM rang_permission WHERE ID like $id LIMIT 1 ") as $row1) {
                    array_push($this->permission, $row1['Permission']);

                    if($this->noperm){
                        $this->noperm = false;
                    }
                }
            }
        }

        return $this->permission;
    }

    function hasPermission($permissionString){
        if($this->noperm){
            return false;
        }

        if(in_array($permissionString, $this->permission)){
            return true;
        }else {
            return false;
        }
    }
}