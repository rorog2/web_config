function hexrg750gr3(nom, cesoUser, cesoMDP, localUser, localMDP, eth2, eth3, eth4, eth5, nat, IPClient, IPGateway)
{
	//Déclaration de l'objet fichier
	var fileSystem = new ActiveXObject("Scripting.fileSystemObject");

	//Déclaration du fichier de configuration
	var fichier = fileSystem.OpenTextFile("../config/hex_rb750gr3.rsc", 1, false);
	var fichierConf = fichier.ReadAll();
	fichier.Close();

	//Déclaration des affectations et des bridges
	var affectation = "add bridge=lan"+eth2+" interface=eth2\
	\nadd bridge=lan"+eth3+" interface=eth3\
	\nadd bridge=lan"+eth4+" interface=eth4\
	\nadd bridge=lan"+eth5+" interface=eth5";

	//Firewall et NAT
	var fichierNAT = fileSystem.OpenTextFile("../config/nat.rsc", 1, false);
	var firewall = fichierNAT.ReadAll();
	firewall.Close();

	//Remplacement
	fichierConf.replace("aaaaaaaa", affectation);
    fichierConf.replace("cccccccc", IPClient);
    fichierConf.replace("gggggggg", IPGateway);
    fichierConf.replace("nnnnnnnn", nom);
    fichierConf.replace("cesoceso", cesoUser);
    fichierConf.replace("CESOMDP", cesoMdp);
    fichierConf.replace("localloc", localUser);
    fichierConf.replace("localmdp", localMdp);
    if(nat == true){
        fichierConf.replace("#=#=#=#=#", firewall);
    }

    return fichierConf;
}