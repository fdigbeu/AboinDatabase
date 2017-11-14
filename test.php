<?php
include_once("resultat-liste-commande.php");

// TEST VALEUR PAR VALEUR AVEC : filterAboin($cmdLine=array())
// En affectant à la variable $searchKey la valeur recherchée.

$resultText = array();
$finalResultText = array();

foreach ($newLoadContent as $key => $value){
	$resultText[] = filterAboin($value);
}
//--
foreach ($resultText as $key => $value){
	if(count($value) > 0){
		$finalResultText[] = $value;
	}
}
//--
if(isset($_GET["p"]) && $_GET["p"] == 2){
	echo "<pre>";
	print_r($finalResultText);
	echo "</pre>";
}

?>