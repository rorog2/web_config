<?php

include('hex_rb750gr3.php');
include('rb951.php');
include('rb3011-uias-rm.php');

$nom = $_POST['nom'];
$cesoUser = $_POST['cesoUser'];
$cesoMdp = $_POST['cesoMdp'];
$localUser = $_POST['localUser'];
$localMdp = $_POST['localMdp'];
$interfaceLAN1 = array();
$interfaceLAN2 = array();
for ($i = 2; $i <= 10; $i++) {
	if(isset($_POST['e1'.$i])){$interfaceLAN1[$i] = $_POST['e1'.$i];}
	if(isset($_POST['e2'.$i])){$interfaceLAN2[$i] = $_POST['e2'.$i];}
}
$nat = $_POST['nat'];
if(isset($_POST['ssid'])){$ssid = $_POST['ssid'];}
if(isset($_POST['psk'])){$psk = $_POST['psk'];}
$IPClient = array();
$IPGateway = array();
for ($i = 1; $i <= 4; $i++) {
	$index = "ipclient".$i;
	$IPClient[$i] = $_POST[$index];
	$index = "ipgateway".$i;
	$IPGateway[$i] = $_POST[$index];
}
$masque = $_POST['masque'];

//Construction des adresses IP
$clientIP = $IPClient[1].".".$IPClient[2].".".$IPClient[3].".".$IPClient[4];
$gatewayIP = $IPGateway[1].".".$IPGateway[2].".".$IPGateway[3].".".$IPGateway[4];

//Récupération de l'affectation des interfaces
for($i=2; $i <= 10; $i++){
    if(isset($interfaceLAN1[$i]) && $interfaceLAN1[$i] == true){
        $affectation[$i] = 1;
    }
    elseif(isset($interfaceLAN2[$i]) && $interfaceLAN2[$i] == true){
        $affectation[$i] = 2;
    }
    else{
        $affectation[$i] = 1;
    }
}



$hex_rb750gr3 = new Hexrb750gr3($nom, $cesoUser, $cesoMdp, $localUser, $localMdp, $affectation[2], $affectation[3], $affectation[4], $affectation[5], $nat, $clientIP, $gatewayIP);
$rb951 = new Rb951($nom, $cesoUser, $cesoMdp, $localUser, $localMdp, $affectation[2], $affectation[3], $affectation[4], $affectation[5], $nat, $ssid, $psk, $clientIP, $gatewayIP);
$rb3011 = new Rb3011($nom, $cesoUser, $cesoMdp, $localUser, $localMdp, $affectation[2], $affectation[3], $affectation[4], $affectation[5], $affectation[6], $affectation[7], $affectation[8], $affectation[9], $affectation[10], $nat, $ssid, $psk, $clientIP, $gatewayIP);

if($_POST['modele'] == 'hex-rb750gr3'){
	file_put_contents('config.rsc', $hex_rb750gr3->afficher_config());
}
elseif($_POST['modele'] == 'rb951'){
	file_put_contents('config.rsc', $rb951->afficher_config());
}
elseif($_POST['modele'] == 'rb3011-uias-rm'){
	file_put_contents('config.rsc', $rb3011->afficher_config());
}

//Génération du fichier de paramètre
$parametres = "Nom du router: ".$nom."\n
Nom d'utilisateur ceso: ".$cesoUser."\n
Mot de passe ceso: ".$cesoMdp."\n
Nom d'utilisateur client: ".$localUser."\n
Mot de passe client: ".$localMdp."\n
Modèle: ".$_POST['modele']."\n
NAT: ".$nat."\n
SSID: ".$ssid."\n
PSK: ".$psk."\n
IP client: ".$clientIP."\n
IP Gateway: ".$gatewayIP;

file_put_contents("parametres.txt", $parametres);

header('Location: index.php?download');
?>