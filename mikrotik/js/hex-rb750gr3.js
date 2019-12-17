function hexrb750gr3(nom, cesoUser, cesoMdp, localUser, localMdp, eth2, eth3, eth4, eth5, nat, IPClient, IPGateway)
{

	//Déclaration du fichier de configuration
	var fichier = new File("../config/hex_rb750gr3.rsc");
	var fichierConf = fichier.getAsText();
	alert('EE');

	//Déclaration des affectations et des bridges
	var affect = "add bridge=lan"+eth2+" interface=eth2\
	\nadd bridge=lan"+eth3+" interface=eth3\
	\nadd bridge=lan"+eth4+" interface=eth4\
	\nadd bridge=lan"+eth5+" interface=eth5";

	alert('Affect');

	//Firewall et NAT
	var fichierNAT = "../config/nat.rsc";
	var firewall = fileSystem.readAsText(fichierNAT, 'UTF-8');

	//Remplacement
	fichierConf.replace("aaaaaaaa", affect);
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

	alert("hex 1");
    return fichierConf;
}