//alert("ALERTE");
/*
###################################################################################
#                                   EVENEMENTS                                    #
###################################################################################
*/

document.getElementById("generer").addEventListener("click", generer);
document.getElementById("modele").addEventListener("change", changementINT);
document.getElementById("nbLAN").addEventListener("change", changementINT);


/*
###################################################################################
#                                     ELEMENTS                                    #
###################################################################################
*/

var nom = document.getElementById("nom").value;
var cesoUser = document.getElementById("cesoUser").value;
var cesoMDP = document.getElementById("cesoMDP").value;
var localUser = document.getElementById("localUser").value;
var localMDP = document.getElementById("localMDP").value;
var modele = document.getElementById("modele").selectedIndex;
var nbLAN = document.getElementById("nbLAN").value;
var index = "";
var interfaceLAN1 = ["", "", "", "", "", "", "", "", ""];
var interfaceLAN2 = ["", "", "", "", "", "", "", "", ""];
for (var i = 2; i <= 10; i++) {
	index = "1" + i;
	interfaceLAN1[i] = document.getElementById(index);
	index = "2" + i;
	interfaceLAN2[i] = document.getElementById(index);
}
var nat = document.getElementById("nat").checked;
var ssid = document.getElementById("ssid").value;
var psk = document.getElementById("psk").value;
var ipClient = ["", "", "", "", "", "", "", "", ""];
var ipGateway = ["", "", "", "", "", "", "", "", ""];
for (var i = 1; i <= 4; i++) {
	index = "ipclient" + i;
	ipClient[i] = document.getElementById(index).value;
	index = "ipgateway" + i;
	ipGateway[i] = document.getElementById(index).value;
}
var masque = document.getElementById("masque").value;


/*
###################################################################################
#                                    FONCTIONS                                    #
###################################################################################
*/

function changementINT() {
	if(modele < 2) {
		if (nbLAN == 1) {
			for (var i = 2; i <= 10; i++) {
				if (i <=5) {
					interfaceLAN1[i].disabled = false;
					interfaceLAN1[i].checked = true;
				}
				else {
					interfaceLAN1[i].disabled = true;
					interfaceLAN1[i].checked = false;
				}
				interfaceLAN2[i].disabled = true;
				interfaceLAN2[i].checked = false;
			}
		}
		else if (nbLAN == 2) {
			for (var i = 2; i <= 10; i++) {
				if (i <= 5) {
					interfaceLAN1[i].disabled = false;
					interfaceLAN1[i].checked = true;
					interfaceLAN2[i].disabled = false;
					interfaceLAN2[i].checked = false;
				}
				else {
					interfaceLAN1[i].disabled = true;
					interfaceLAN1[i].checked = false;
					interfaceLAN2[i].disabled = true;
					interfaceLAN2[i].checked = false;
				}
			}
		}
		if (modele == 1) {
			ssid.disabled = false;
			psk.disabled = false;
		}
		else{
			ssid.disabled = true;
			ssid.value = "";
			psk.disabled = true;
			psk.value = "";
		}
	}
	else if (modele == 2) {
		if (nbLAN == 1) {
			for (var i = 2; i <= 10; i++) {
				interfaceLAN1[i].disabled = false;
				interfaceLAN1[i].checked = true;
				interfaceLAN2[i].disabled = true;
				interfaceLAN2[i].checked = false;
			}
		}
		else if (nbLAN == 2) {
			for (var i = 2; i <= 10; i++) {
				interfaceLAN1[i].disabled = false;
				interfaceLAN1[i].checked = true;
				interfaceLAN2[i].disabled = false;
				interfaceLAN2[i].checked = false;
			}
		}
		ssid.disabled = true;
		ssid.value = "";
		psk.disabled = true;
		psk.value = "";
	}
}


function generer() {
	//Montage des IPs
	var clientIP = ipClient[1] + "." + ipClient[2] + "." + ipClient[3] + "." + ipClient[4];
	var gatewayIP = ipGateway[1] + "." + ipGateway[2] + "." + ipGateway[3] + "." + ipGateway[4];
	if (masque != 31) {
		clientIP += masque;
	}

	//Vérification du champs nom
	if (nom == "") {
		alert("Vous n'avez pas renseigné de nom pour le routeur !");
		return;
	}
	
	//Vérification des champs d'authentification
	if (cesoUser == "" || cesoMDP == "") {
		alert("Vous avez mal renseigné les information d'authentification pour CESO !");
		return;
	}
	if (localUser == "" || localMDP == "") {
		alert("Vous avez mal renseigné les information d'authentification pour l'utilisateur local !");
		return;
	}

	//Vérification de l'affectation des interfaces
	var lan1 = ["", "", "", "", "", "", "", "", ""];
	var lan2 = ["", "", "", "", "", "", "", "", ""];
	for (var i = 2; i <= 10; i++) {
		lan1[i] = interfaceLAN1[i].checked;
		lan2[i] = interfaceLAN2[i].checked;
		if (lan1[i] == true && lan2[i] == true) {
			alert("Vous ne pouvez pas affecter une interface à plusieurs LAN !");
			return;
		}
		else if (lan1[i] == false && lan2[i] == false && modele == 2) {
			alert("Vous n'avez pas affecter toutes les interfaces dans le ou les LAN !");
			return;
		}
	}

	//Vérirication des paramètres Wifi
	if (modele == 1) {
		if (ssid == "" || psk == "") {
			alert("Vous avez mal renseigné les champs de la configuration Wifi !");
			return;
		}
	}

	//Vérification des adresses IPs
	for (var i = 1; i <= 4; i++) {
		if(ipClient[i] == "") {
			alert("Vous avez mal renseigné l'adresse IP du client !");
			return;
		}
	}
	for (var i = 1; i <= 4; i++) {
		if(ipGateway[i] == "") {
			alert("Vous avez mal renseigné l'adresse IP de la gateway !");
			return;
		}
	}

	//Vérification des @IPs identiques
	if (ipClient[1] + "." + ipClient[2] + "." + ipClient[3] + "." + ipClient[4] == ipGateway[1] + "." + ipGateway[2] + "." + ipGateway[3] + "." + ipGateway[4]) {
		alert("Les adresses IP renseignées sont identiques !");
		return;
	}

	//Vérification du masque
	if (masque < 25 || masque > 31) {
		alert("Le masque n'est pas compris entre 25 et 31 !");
		return;
	}

	//Récupération de l'affectation des interfaces
	var affectation = ["", "", "", "", "", "", "", "", "", ""];
	for (var i = 2; i <= 10; i++) {
		if (interfaceLAN1[i].checked == true) {
			affectation[i] = 1;
		}
		else if (interfaceLAN2[i].checked == true) {
			affectation[i] = 2;
		}
		else {
			affectation[i] = 1;
		}
	}

	//---------------------------SAUVEGARDE FICHIER--------------------------------
	//Récupération de la configuration
	var hex_rb750gr3 = hexrb750gr3(nom, cesoUser, cesoMDP, localUser, localMDP, affectation[2], affectation[3], affectation[4], affectation[5], nat, clientIP, gatewayIP);
	alert("Conf 1");

	//Sélection de la configuration
	var configuration = "";
	if (modele == 0) {
		configuration = hex_rb750gr3;
	}
	else if (modele == 1) {
		configuration = rb951;
	}
	else if (modele == 2) {
		configuration = rb9011;
	}

	//Ecriture dans un fichier
	var fileSystem = new ActiveXObject("Scripting.fileSystemObject");
	var fichier = fileSystem.OpenTextFile("../config/configuration.rsc", 2, true);

	//Ecriture dans un fichier
	fichier.Write(configuration);
	fichier.Close();

	window.open("../config/configuration.rsc", "_blank", null);

/*
	//Création d'un lien
	var download = document.createElement('a');

	//Contenu
	dowload.setAttribute('href',"data:text/plain;charset=utf-8,"+encodeURIComponent("coucou c'est moi !!!"));

	//Nom du fichier
	download.setAttribute('download',"test.txt");

	//Simulation d'un click
	download.click();

*/
}


/*
###################################################################################
#                               PARAMETRES DE BASE                                #
###################################################################################
*/

changementINT();
ssid.disabled = true;
psk.disabled = true;