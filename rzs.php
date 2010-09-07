<?php
require_once 'config.php';
require_once 'identica.php';

$dent = new Identica(USER, PASS, 'RaumZeitStatus');

$status = file_get_contents('http://status.raumzeitlabor.de/api/simple');

switch($status){
	case 0:
		$text = "RaumZeitLabor ist nun geschlossen.";
		break;
	case 1:
		$text = "RaumZeitLabor ist nun geoeffnet.";
		break;
}

$nbr = file_get_contents("nbr");

echo "nbr = ". $nbr." - status ". $status;

if($text AND $nbr != $status){
	$dent->updateStatus($text, array(
		'lat'  => 49.507918,
		'long' => 8.499529,
	));

	$datei = fopen("nbr","w");
	fwrite($datei, $status);
	fclose($datei);
}
?>
