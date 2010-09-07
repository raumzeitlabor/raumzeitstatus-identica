<?php
include('identica.php');

$dent = new Identica("raumzeitstatus", "PASSWORT", "RaumZeitStatus");

$status = file_get_contents("http://scytale.name/files/tmp/rzlstatus.txt");

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
	$dent->updateStatus($text);

	$datei = fopen("nbr","w");
  	fwrite($datei, $status);
  	fclose($datei);
}
?>
