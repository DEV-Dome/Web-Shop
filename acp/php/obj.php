<?php

class ErrorObj{
	public $error;
	public $errorIndex = 1;
	public $Noerror = true;
	public $prefix = "[Eingabe-Fehler] ";
	
	function __construct($name) {
		$error = array();
		$this->prefix = "[".$name."] ";
	}
	function addError($addErrorCode){
		$i = $this->errorIndex;
		
		if(is_array($this->error)){
			array_push($this->error, "#$i - $addErrorCode");
		}else {
			$this->error = array("#$i - $addErrorCode");
		}
		
		if($this->Noerror) $this->Noerror = false;
		$this->errorIndex++;
	}

	function giveErrosAsTable(){
	    $erg = " <table><thead><tr><th>Nummer</th><th>Fehler</th></tr></thead><tbody>";
		/*$erg = "<ul style='width: 80vw; left: 10vw;' class='center collection '>";
		$erg .= "<li class='#b2dfdb teal lighten-4 '><h5>Fehler die der Eingabe:</h5></li>";*/
		
		for($i = 1; $i < $this->errorIndex; $i++){
		    $erg .= "<tr><td>$i</td><td>".$this->error[$i-1]."</td></tr>";

			
		}
		$erg.=	"  </tbody></table>";

		return $erg;
	}

	function giveErro(){
	    $erg = "";
        for($i = 1; $i < $this->errorIndex; $i++){
            $erg .= $this->error[$i-1]. "<br/>";
        }
        return $erg;
	}
	function isNoError(){
		return $this->Noerror;
	}
}

function test_iban( $iban ) {
    $iban = str_replace( ' ', '', $iban );
    $iban1 = substr( $iban,4 ). strval( ord( $iban{0} )-55 )  . strval( ord( $iban{1} )-55 ). substr( $iban, 2, 2 );

    $rest=0;
    for ( $pos=0; $pos<strlen($iban1); $pos+=7 ) {
        $part = strval($rest) . substr($iban1,$pos,7);
        $rest = intval($part) % 97;
    }
    $pz = sprintf("%02d", 98-$rest);

    if ( substr($iban,2,2)=='00')
        return substr_replace( $iban, $pz, 2, 2 );
    else
        return ($rest==1) ? true : false;
}
?>