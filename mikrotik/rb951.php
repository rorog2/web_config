<?php

class Rb951
{
	private $fichierConf;
	private $firewall;

	public function __construct($nom, $cesoUser, $cesoMdp, $localUser, $localMdp, $eth2, $eth3, $eth4, $eth5, $nat, $ssid, $psk, $IPClient, $IPGateway)
	{
		//Fichier de configuration
		$file = 'config/rb951.rsc';
		$fichier = fopen($file, 'r');
		$this->fichierConf = fread($fichier, filesize ($file));
		fclose($fichier);


		//Déclaration des affections des bridges
    	$affectation = "add bridge=lan".$eth2." interface=eth2
add bridge=lan".$eth3." interface=eth3
add bridge=lan".$eth4." interface=eth4
add bridge=lan".$eth5." interface=eth5";

    	//Firewall et NAT
    	$fileNAT = 'config/nat.rsc';
    	$fichierNAT = fopen($fileNAT, 'r');
		$this->firewall = fread($fichierNAT, filesize ($fileNAT));
        fclose($fichierNAT);


    	//Remplacement
    	$this->fichierConf = str_replace("aaaaaaaa", $affectation, $this->fichierConf);
    	$this->fichierConf = str_replace("cccccccc", $IPClient, $this->fichierConf);
    	$this->fichierConf = str_replace("gggggggg", $IPGateway, $this->fichierConf);
    	$this->fichierConf = str_replace("ssidssid", $ssid, $this->fichierConf);
    	$this->fichierConf = str_replace("pskpskps", $psk, $this->fichierConf);
    	$this->fichierConf = str_replace("nnnnnnnn", $nom, $this->fichierConf);
    	$this->fichierConf = str_replace("cesoceso", $cesoUser, $this->fichierConf);
    	$this->fichierConf = str_replace("CESOMDP", $cesoMdp, $this->fichierConf);
    	$this->fichierConf = str_replace("localloc", $localUser, $this->fichierConf);
    	$this->fichierConf = str_replace("localmdp", $localMdp, $this->fichierConf);
    	if($nat == true){
        	$this->fichierConf = str_replace("#=#=#=#=#", $this->firewall, $this->fichierConf);
    	}
	}

	public function afficher_config()
	{
		return $this->fichierConf;
	}
}

?>