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
$finalPagination = array();
$valueByPage = 500;
$cmptNumber = 0;
$cmptPage = 0;
//--
foreach ($finalResultText as $key => $value){
	$cmptNumber++;
	if($cmptNumber <= $valueByPage){
		$finalPagination[$cmptPage][] = $value;
		if($cmptNumber == $valueByPage){
			$cmptNumber = 0;
			$cmptPage++;
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