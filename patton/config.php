<?php
//Inclusion des classes modèles
include('m4131.php');

//De base
$hostname = $_POST['hostname'];
$administrator = $_POST['administrator'];
$mdp = $_POST['mdp'];
$modele = $_POST['modele'];

//IP et Eth0
$ipaddress = $_POST['ipaddress'];
if(isset($_POST['mask'])){ $mask = $_POST['mask']; }
if(isset($_POST['gateway'])){ $gateway = $_POST['gateway']; }
if(isset($_POST['dns'])){ $svdns = $_POST['dns']; }
if(isset($_POST['sntp'])){ $svsntp = $_POST['sntp']; }

//SIP
$sipserverIP = $_POST['sipserverIP'];
$sipserverPort = $_POST['sipserverPort'];
$sipserverLogin = $_POST['sipserverLogin'];
$sipserverPassword = $_POST['sipserverPassword'];

//BRI
$l2protocol = $_POST['l2protocol'];
$incallform = $_POST['incallform'];
$outcallform = $_POST['outcallform'];

//PRI
$canauxt2 = $_POST['canauxt2'];

//Adressage
if(strtolower($ipaddress) == "dhcp"){
	$adressage = "dhcp";
	$gateway = "";
	$dns = "0";
	$sntp = "";
}
else{
	$adressage = "static ".$ipaddress." ".$mask;
	$gateway = "route 0.0.0.0/0 gateway ".$gateway." metric 0";
	$dns = $svdns;
	$sntp = $svsntp;
}

//Format d'appel
//Entrant
$incall = "execute 1 CALLED_".$incallform."DIGITS";

//Sortant
if($outcallform == "9"){
	$outcall = "execute 1 CALLING_9DIGITS";
}
else{
	$outcall = "";
}


//Classe
$m4131 = new M4131($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall);

if($modele == "4131"){
	file_put_contents('config.cfg', $m4131->afficher_config());
}

header('Location: index.php');

?>