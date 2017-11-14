<?php
// Read Text file
function readTextFile($filename)
{
	$ligne = array();
	$fp = fopen($filename,"r");
	while (!feof($fp))
	{
		$ligne[] = fgets($fp, 8192);
	}
	return $ligne;
}

// Filter by
function filterAboin($cmdLine=array()){
	
	$searchKey = "ND=";
	$resultat = array();
	
	foreach ($cmdLine as $key => $value){
		// Retrieve each value
		$mystring = trim($value);
		//--
		$pos = strpos($mystring, $searchKey);
		// If its exists
		if ($pos !== false) {
			$resultat[] = $mystring;
		}
	}
	//--
	return $resultat;
	// echo "<pre>"; print_r($resultat); echo "</pre>";
}

// Get aboin infos
// TY= : Can be on multiple lines (Retrieve differents values)
// NDG= : Verify if "LOI1=" or "LOI2=" is not in the same line
// NDS= : Can be on multiple lines (Retrieve next lines that begin by "+") : Verify if "ND=" is in the same Line
// ND= : Can be on multiple lines : Verify if "NDS=" or "NE  =" or "ACH=" is in the same line
// NE  = : Can be on multiple lines
// NAR= : Verify that "TYPE=3" or "TYPE=4" don't exist before taking its value
// TYPE=3 : Retrieve its value. (Don't retrieve "TYPE=4" value if those are in the same line)
// TYPE=4 : Retrieve its value. (Don't retrieve "TYPE=3" value if those are in the same line)
// "ACH=" verify if "ND" is in the same line
function getAboinInfos($cmdLine=array()){
	
	$resultat = array();
	$keyToSearch = array("TY=", "NDG=", "NDS=", "CAT=", "ND=", "NE  =", "MAR=", "NAR=", "TYPE=3", "TYPE=4", "ACH=", "+");
		
	$TY_VALUE = array(); $TY_CONTROLE = array();
	$NDG_VALUE = array(); $NDG_CONTROLE = array();
	$NDS_VALUE = array(); $NDS_CONTROLE = array();
	$CAT_VALUE = array(); $CAT_CONTROLE = array();
	$ND_VALUE = array(); $ND_CONTROLE = array();
	$NE_VALUE = array(); $NE_CONTROLE = array();
	$MAR_VALUE = array(); $MAR_CONTROLE = array();
	$NAR_VALUE = array(); $NAR_CONTROLE = array();
	$TYPE_3_VALUE = array(); $TYPE_3_CONTROLE = array();
	$TYPE_4_VALUE = array(); $TYPE_4_CONTROLE = array();
	$ACH_VALUE = array(); $ACH_CONTROLE = array();

	foreach ($cmdLine as $key => $value){
	
		// Retrieve each value
		$mystring = str_ireplace(";", " ", trim($value));
		// Search each Key
		foreach ($keyToSearch as $k => $v){
			$findme = $v;
			$pos = strpos($mystring, $findme);
			// If its exists
			if ($pos !== false) {
				switch ($findme){
					
					case "TY=":
						$dataValue = trim(str_ireplace("TY=", "", $mystring));
						if(!isset($TY_CONTROLE[$dataValue])){
							$TY_CONTROLE[$dataValue] = "OK";
							$TY_VALUE[] = $dataValue;
						}
						break;
					
					case "NDG=":
						$dataValue = trim(str_ireplace("NDG=", "", $mystring));
						// If "LOI1=" exists
						if(strpos($dataValue, "LOI1=") !== false){
							$tabDataValue = explode("LOI1=", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($NDG_CONTROLE[$dataValue])){
								$NDG_CONTROLE[$dataValue] = "OK";
								$NDG_VALUE[] = $dataValue;
							}
						}
						// If "LOI2=" exists
						else if(strpos($dataValue, "LOI2=") !== false){
							$tabDataValue = explode("LOI2=", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($NDG_CONTROLE[$dataValue])){
								$NDG_CONTROLE[$dataValue] = "OK";
								$NDG_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($NDG_CONTROLE[$dataValue])){
								$NDG_CONTROLE[$dataValue] = "OK";
								$NDG_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "NDS=":
						$dataValue = trim(str_ireplace("NDS=", "", $mystring));
						// if "ND=" exists
						if(strpos($dataValue, "ND=") !== false){
							$tabDataValue = explode("ND=", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($NDS_CONTROLE[$dataValue])){
								$NDS_CONTROLE[$dataValue] = "OK";
								$NDS_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($NDS_CONTROLE[$dataValue])){
								$NDS_CONTROLE[$dataValue] = "OK";
								$NDS_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "CAT=":
						// If it's begin by this
						if($pos == 0){
							$dataValue = trim(str_ireplace("CAT=", "", $mystring));
							if(!isset($CAT_CONTROLE[$dataValue])){
								$CAT_CONTROLE[$dataValue] = "OK";
								$CAT_VALUE[] = $dataValue;
							}
						}
						else{
							$tableDataValue = explode("CAT=", $mystring);
							$dataValue = trim($tableDataValue[1]);
							if(!isset($CAT_CONTROLE[$dataValue])){
								$CAT_CONTROLE[$dataValue] = "OK";
								$CAT_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "ND=":
						$dataValue = trim(str_ireplace("ND=", "", $mystring));
						// If "NDS=" exists
						if(strpos($dataValue, "NDS=") !== false){
							$tableDataValue = explode("ND=", $mystring);
							$dataValue = trim($tableDataValue[1]);
							if(!isset($ND_CONTROLE[$dataValue])){
								$ND_CONTROLE[$dataValue] = "OK";
								$ND_VALUE[] = $dataValue;
							}
						}
						// If "ACH=" exists
						else if(strpos($dataValue, "ACH=") !== false){
							$tabDataValue = explode("ACH=", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($ND_CONTROLE[$dataValue])){
								$ND_CONTROLE[$dataValue] = "OK";
								$ND_VALUE[] = $dataValue;
							}
						}
						// If "NE  =" exists
						else if(strpos($dataValue, "NE  =") !== false){
							$tabDataValue = explode("NE  =", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($ND_CONTROLE[$dataValue])){
								$ND_CONTROLE[$dataValue] = "OK";
								$ND_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($ND_CONTROLE[$dataValue])){
								$ND_CONTROLE[$dataValue] = "OK";
								$ND_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "NE  =":// If it's begin by this
						if($pos == 0){
							$dataValue = trim(str_ireplace("NE  =", "", $mystring));
							if(!isset($NE_CONTROLE[$dataValue])){
								$NE_CONTROLE[$dataValue] = "OK";
								$NE_VALUE[] = $dataValue;
							}
						}
						else{
							$tableDataValue = explode("NE  =", $mystring);
							$dataValue = trim($tableDataValue[1]);
							if(!isset($NE_CONTROLE[$dataValue])){
								$NE_CONTROLE[$dataValue] = "OK";
								$NE_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "MAR=":
						$dataValue = trim(str_ireplace("MAR=", "", $mystring));
						if(!isset($MAR_CONTROLE[$dataValue])){
							$MAR_CONTROLE[$dataValue] = "OK";
							$MAR_VALUE[] = $dataValue;
						}
						break;
					
					case "NAR=":
						$dataValue = trim(str_ireplace("NAR=", "", $mystring));
						// If "TYPE=3" or "TYPE=4" doesn't exists
						if(strpos($dataValue, "TYPE=3") === false || strpos($dataValue, "TYPE=4") === false){
							if(!isset($NAR_CONTROLE[$dataValue])){
								$NAR_CONTROLE[$dataValue] = "OK";
								$NAR_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "TYPE=3":
						$dataValue = trim(str_ireplace("TYPE=3", "", $mystring));
						// If "TYPE=4" exists
						if(strpos($dataValue, "TYPE=4") !== false){
							$tabDataValue = explode("TYPE=4", $dataValue);
							$dataValue = trim($tabDataValue[0]);
							if(!isset($TYPE_3_CONTROLE[$dataValue])){
								$TYPE_3_CONTROLE[$dataValue] = "OK";
								$TYPE_3_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($TYPE_3_CONTROLE[$dataValue])){
								$TYPE_3_CONTROLE[$dataValue] = "OK";
								$TYPE_3_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "TYPE=4":
						// If "TYPE=3" exists
						if(strpos($mystring, "TYPE=3") !== false){
							$tabDataValue = explode("TYPE=4", $mystring);
							$dataValue = trim($tabDataValue[1]);
							if(!isset($TYPE_4_CONTROLE[$dataValue])){
								$TYPE_4_CONTROLE[$dataValue] = "OK";
								$TYPE_4_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($TYPE_4_CONTROLE[$dataValue])){
								$TYPE_4_CONTROLE[$dataValue] = "OK";
								$TYPE_4_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "ACH=":
						// If "ND=" exists
						if(strpos($mystring, "ND=") !== false){
							$tabDataValue = explode("ACH=", $mystring);
							$dataValue = trim($tabDataValue[1]);
							if(!isset($ACH_CONTROLE[$dataValue])){
								$ACH_CONTROLE[$dataValue] = "OK";
								$ACH_VALUE[] = $dataValue;
							}
						}
						else{
							if(!isset($ACH_CONTROLE[$dataValue])){
								$ACH_CONTROLE[$dataValue] = "OK";
								$ACH_VALUE[] = $dataValue;
							}
						}
						break;
					
					case "+": // Continue NDS value
						// Verify "CAT=" doesn't exists
						if(strpos($mystring, "CAT=") === false){
							if ($mystring[0] == "+" || $mystring[0] == "<"){
								$NDS_VALUE[] = $mystring;
							}
						}
						break;
				}
			}
		}
	}
	//-- Final Result
	$resultat["TY_VALUE"] = count($TY_VALUE) == 0 ? "" : (count($TY_VALUE) == 1 ? $TY_VALUE[0] : $TY_VALUE);
	$resultat["NDG_VALUE"] = count($NDG_VALUE) == 0 ? "" : (count($NDG_VALUE) == 1 ? $NDG_VALUE[0] : $NDG_VALUE);
	$resultat["NDS_VALUE"] = count($NDS_VALUE) == 0 ? "" : (count($NDS_VALUE) == 1 ? $NDS_VALUE[0] : $NDS_VALUE);
	$resultat["CAT_VALUE"] = count($CAT_VALUE) == 0 ? "" : (count($CAT_VALUE) == 1 ? $CAT_VALUE[0] : $CAT_VALUE);
	$resultat["ND_VALUE"] = count($ND_VALUE) == 0 ? "" : (count($ND_VALUE) == 1 ? $ND_VALUE[0] : $ND_VALUE);
	$resultat["NE_VALUE"] = count($NE_VALUE) == 0 ? "" : (count($NE_VALUE) == 1 ? $NE_VALUE[0] : $NE_VALUE);
	$resultat["MAR_VALUE"] = count($MAR_VALUE) == 0 ? "" : (count($MAR_VALUE) == 1 ? $MAR_VALUE[0] : $MAR_VALUE);
	$resultat["NAR_VALUE"] = count($NAR_VALUE) == 0 ? "" : (count($NAR_VALUE) == 1 ? $NAR_VALUE[0] : $NAR_VALUE);
	$resultat["TYPE_3_VALUE"] = count($TYPE_3_VALUE) == 0 ? "" : (count($TYPE_3_VALUE) == 1 ? $TYPE_3_VALUE[0] : $TYPE_3_VALUE);
	$resultat["TYPE_4_VALUE"] = count($TYPE_4_VALUE) == 0 ? "" : (count($TYPE_4_VALUE) == 1 ? $TYPE_4_VALUE[0] : $TYPE_4_VALUE);
	$resultat["ACH_VALUE"] = count($ACH_VALUE) == 0 ? "" : (count($ACH_VALUE) == 1 ? $ACH_VALUE[0] : $ACH_VALUE);
	
	// SUBSCRIBER
	$tableType = array("KLA"=>"POTS", "NBS1" => "T0", "NBS2" => "T2");
	$typeSubscriber="";
	
	if(!empty(trim($resultat["TY_VALUE"]))){
		foreach ($tableType as $key => $value){
			// If exists
			if(!is_array($resultat["TY_VALUE"]) && (strpos($resultat["TY_VALUE"], $key) !== false)){
				$typeSubscriber .= $value;
				if(is_array($resultat["ND_VALUE"])){
					$typeSubscriber .= count($resultat["ND_VALUE"]) > 1 ? " multiline" : (count($resultat["ND_VALUE"]) == 1 ? " monoline" : "");
				}
				else{
					if(!empty(trim($resultat["ND_VALUE"]))){
						$typeSubscriber .= " monoline";
					}
				}
				$resultat["TYPE_VALUE"] = $typeSubscriber;
				break;
			}
			else{
				// Never to find a table
				$resultat["TYPE_VALUE"] = $typeSubscriber;
			}
		}
	}
	else{
		$resultat["TYPE_VALUE"] = $typeSubscriber;
	}
	
	//--
	return $resultat;
}
?>