<?php

class M4171
{
	private $fichierConf;

	public function __construct($hostname, $administrator, $mdp, $adressage, $gateway, $dns, $sntp, $sipserverIP, $sipserverPort, $sipserverLogin, $sipserverPassword, $l2protocol, $incall, $outcall, $canauxt2)
	{
		$file = 'config/4171.cfg';
		$fichier = fopen($file, 'r');
		$this->fichierConf = fread($fichier, filesize ($file));
		fclose($fichier);

		$this->fichierConf = str_replace("HOSTHOST", $hostname, $this->fichierConf);
		$this->fichierConf = str_replace("DNSDNSDN", $dns, $this->fichierConf);
		$this->fichierConf = str_replace("GGGGGGGG", $gateway, $this->fichierConf);
		$this->fichierConf = str_replace("AAAAAAAA", $adressage, $this->fichierConf);
		$this->fichierConf = str_replace("UUUUUUUU", $administrator, $this->fichierConf);
		$this->fichierConf = str_replace("PPPPPPPP", $mdp, $this->fichierConf);
		$this->fichierConf = str_replace("SIPSIPSI", $sipserverIP, $this->fichierConf);
		$this->fichierConf = str_replace("SIPPSIPP", $sipserverPort, $this->fichierConf);
		$this->fichierConf = str_replace("USIPUSIP", $sipserverLogin, $this->fichierConf);
		$this->fichierConf = str_replace("PSIPPSIP", $sipserverPassword, $this->fichierConf);
		$this->fichierConf = str_replace("L2PL2PL2", $l2protocol, $this->fichierConf);
		$this->fichierConf = str_replace("FAEFAEFA", $incall, $this->fichierConf);
		$this->fichierConf = str_replace("FASFASFA", $outcall, $this->fichierConf);
		$this->fichierConf = str_replace("T2T2T2T2", $canauxt2, $this->fichierConf);
	}

	public function afficher_config()
	{
		return $this->fichierConf;
	}
}

?>