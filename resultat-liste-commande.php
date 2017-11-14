<?php
include_once("fonctions.php");

// TRAITEMENT TGLAIN EXC

$newLoadContent = array();
$tableItem = array();
$loadContent = readTextFile("uploads/aboin-customer.txt");

foreach($loadContent as $key => $value){
	if(!empty(trim($value))){
		$tableItem[] = $value;
		if(trim($value) == "TRAITEMENT TGLAIN EXC"){
				$newLoadContent[] = $tableItem;
				$tableItem = array();
		}
	}
}

//--
if(isset($_GET["p"]) && $_GET["p"] == 1){
	echo "<pre>";
	print_r($newLoadContent);
	echo "</pre>";
}
?>