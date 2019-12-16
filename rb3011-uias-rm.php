<?php

class Rb3011
{
	private $fichierConf;
	private $firewall;

	public function __construct($nom, $cesoUser, $cesoMdp, $localUser, $localMdp, $eth2, $eth3, $eth4, $eth5, $eth6, $eth7, $eth8, $eth9, $eth10, $nat, $IPClient, $IPGateway)
	{
		//Fichier de configuration
		$file = 'config/rb3011.rsc';
		$fichier = fopen($file, 'r');
		$this->fichierConf = fread($fichier, filesize ($file));
		fclose($fichier);


		//Déclaration des affections des bridges
    	$affectation = "add bridge=lan".$eth2." interface=eth2
add bridge=lan".$eth3." interface=eth3
add bridge=lan".$eth4." interface=eth4
add bridge=lan".$eth5." interface=eth5
add bridge=lan".$eth6." interface=eth6
add bridge=lan".$eth7." interface=eth7
add bridge=lan".$eth8." interface=eth8
add bridge=lan".$eth9." interface=eth9
add bridge=lan".$eth10." interface=eth10";

    	//Firewall et NAT
    	$fileNAT = 'config/nat.rsc';
    	$fichierNAT = fopen($fileNAT, 'r');
		$this->firewall = fread($fichierNAT, filesize ($fileNAT));


    	//Remplacement
    	$this->fichierConf = str_replace("aaaaaaaa", $affectation, $this->fichierConf);
    	$this->fichierConf = str_replace("cccccccc", $IPClient, $this->fichierConf);
    	$this->fichierConf = str_replace("gggggggg", $IPGateway, $this->fichierConf);
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