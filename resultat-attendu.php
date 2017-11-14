<?php
include_once("resultat-liste-commande.php");

$page = isset($_GET["f"]) ? str_ireplace("-", " ", $_GET["f"]) : "";
$resultText = array();
$finalResultText = array();

foreach ($newLoadContent as $key => $value){
	$resultText[] = getAboinInfos($value);
}
//--
foreach ($resultText as $key => $value){
	if(count($value) > 0){
		if($page == ""){
			$finalResultText[] = $value;
		}
		else{
			if($page == trim($value["TYPE_VALUE"])){
				$finalResultText[] = $value;
			}
		}
	}
}
//--
if(isset($_GET["p"]) && $_GET["p"] == 3){
	echo "<pre>";
	print_r($finalResultText);
	echo "</pre>";
}
?>