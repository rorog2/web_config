<?php

//Inclusion des classes modèles
include('m4131.php');
include('m4171.php');
include('m4634.php');
include('m4638.php');
include('m4970.php');


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
$m4171 = new M4171($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall, $canauxt2);
$m4638 = new M4634($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall);
$m4634 = new M4638($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall);
$m4970 = new M4970($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall, $canauxt2);

unlink("config.cfg");
unlink("parametres.txt");

//Génération du fichier de configuration
if($modele == "4131"){
	file_put_contents('config.cfg', $m4131->afficher_config());
}
elseif($modele == "4171"){
	file_put_contents("config.cfg", $m4171->afficher_config());
}
elseif($modele == "4634"){
	file_put_contents("config.cfg", $m4634->afficher_config());
}
elseif($modele == "4638"){
	file_put_contents("config.cfg", $m4638->afficher_config());
}
elseif($modele == "4970"){
	file_put_contents("config.cfg", $m4970->afficher_config());
}

//Génération du fichier des paramètres
$parametres = "Hostname: ".$hostname."\n
Login administrateur: ".$administrator."\n
Mot de passe administrateur: ".$mdp."\n
Modele: ".$modele."\n
Adresse IP: ".$adressage."\n
Gateway: ".$gateway."\n
Serveur SIP: ".$sipserverIP."\n
Port serveur SIP: ".$sipserverPort."\n
Login serveur SIP: ".$sipserverLogin."\n
Password serveur SIP: ".$sipserverPassword."\n
Layer 2 protocol: ".$l2protocol."\n
Format d'appel entrant: ".$incallform." chiffres\n
Format d'appel sortant: ".$outcallform." chiffres";

file_put_contents("parametres.txt", $parametres);

header('Location: index.php?download');

?>