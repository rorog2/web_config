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

var nom = document.getElementById("nom");
var cesoUser = document.getElementById("cesoUser");
var cesoMDP = document.getElementById("cesoMDP");
var localUser = document.getElementById("localUser");
var localMDP = document.getElementById("localMDP");
var modele = document.getElementById("modele");
var nbLAN = document.getElementById("nbLAN");
var index = "";
var interfaceLAN1 = ["", "", "", "", "", "", "", "", ""];
var interfaceLAN2 = ["", "", "", "", "", "", "", "", ""];
for (var i = 2; i <= 10; i++) {
	index = "1" + i;
	interfaceLAN1[i] = document.getElementById(index);
	index = "2" + i;
	interfaceLAN2[i] = document.getElementById(index);
}
var nat = document.getElementById("nat");
var ssid = document.getElementById("ssid");
var psk = document.getElementById("psk");
var ipClient = ["", "", "", "", "", "", "", "", ""];
var ipGateway = ["", "", "", "", "", "", "", "", ""];
for (var i = 1; i <= 4; i++) {
	index = "ipclient" + i;
	ipClient[i] = document.getElementById(index);
	index = "ipgateway" + i;
	ipGateway[i] = document.getElementById(index);
}
var masque = document.getElementById("masque");


/*
###################################################################################
#                                    FONCTIONS                                    #
###################################################################################
*/

function changementINT() {
	if(modele.value == "hex-rb750gr3" || modele.value == "rb951") {
		if (nbLAN.value == 1) {
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
		else if (nbLAN.value == 2) {
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
		if (modele.value == "rb951") {
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
	else if (modele.value == "rb3011-uias-rm") {
		if (nbLAN.value == 1) {
			for (var i = 2; i <= 10; i++) {
				interfaceLAN1[i].disabled = false;
				interfaceLAN1[i].checked = true;
				interfaceLAN2[i].disabled = true;
				interfaceLAN2[i].checked = false;
			}
		}
		else if (nbLAN.value == 2) {
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
	var clientIP = ipClient[0].value + "." + ipClient[1].value + "." + ipClient[2].value + "." + ipClient[3].value;
	var gatewayIP = ipGateway[0].value + "." + ipGateway[1].value + "." + ipGateway[2].value + "." + ipGateway[3].value;
	if (masque.value != 31) {
		clientIP += masque.value;
	}

	//Vérification du champs nom
	if (nom.value == "") {
		alert("Vous n'avez pas renseigné de nom pour le routeur !");
		return;
	}

	//Vérification des champs d'authentification
	if (cesoUser.value == "" || cesoMDP.value == "") {
		alert("Vous avez mal renseigné les information d'authentification pour CESO !");
		return;
	}
	if (localUser.value == "" || localMDP.value == "") {
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
		else if (lan1[i] == false && lan2[i] == false) {
			alert("Vous n'avez pas affecter toutes les interfaces dans le ou les LAN !");
			return;
		}
	}

	//Vérirication des paramètres Wifi
	if (modele.value == "rb951") {
		if (ssid.value == "" || psk.value == "") {
			alert("Vous avez mal renseigné les champs de la configuration Wifi !");
			return;
		}
	}

	//Vérification des adresses IPs
	for (var i = 1; i <= 4; i++) {
		if(ipClient[i].value == "") {
			alert("Vous avez mal renseigné l'adresse IP du client !");
			return;
		}
	}
	for (var i = 1; i <= 4; i++) {
		if(ipGateway[i].value == "") {
			alert("Vous avez mal renseigné l'adresse IP de la gateway !");
			return;
		}
	}

	//Vérification des @IPs identiques
	if (ipClient[0].value + "." + ipClient[1].value + "." + ipClient[2].value + "." + ipClient[3].value == ipGateway[0].value + "." + ipGateway[1].value + "." + ipGateway[2].value + "." + ipGateway[3].value) {
		alert("Les adresses IP renseignées sont identiques !");
		return;
	}

	//Vérification du masque
	if (masque.value < 25 || masque.value > 31) {
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
}


/*
###################################################################################
#                               PARAMETRES DE BASE                                #
###################################################################################
*/

changementINT();
ssid.disabled = true;
psk.disabled = true;