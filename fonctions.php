<?php
// Lecture d'un fichier texte
function lireFichier($filename)
{
	$ligne = array();
	$fp = fopen($filename,"r");
	while (!feof($fp))
	{
		$ligne[] = fgets($fp, 8192);
	}
	return $ligne;
}

?>