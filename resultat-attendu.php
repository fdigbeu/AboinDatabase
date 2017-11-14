<?php
include_once("fonctions.php");

// TRAITEMENT TGLAIN EXC

$newLoadContent = array();
$tableItem = array();
$loadContent = lireFichier("uploads/aboin-customer.txt");

foreach($loadContent as $key => $value){
	if(!empty(trim($value))){
		$tableItem[] = $value;
		if(trim($value) == "TRAITEMENT TGLAIN EXC"){
				$newLoadContent[] = $tableItem;
				$tableItem = array();
		}
	}
}

echo "<pre>";
print_r($newLoadContent);
echo "</pre>";
?>