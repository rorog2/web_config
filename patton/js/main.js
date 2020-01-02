//alert("ALERTE");
/*
###################################################################################
#                                   EVENEMENTS                                    #
###################################################################################
*/

document.getElementById("generer").addEventListener("click", generer);
document.getElementById("modele").addEventListener("change", changementModele);



/*
###################################################################################
#                                     ELEMENTS                                    #
###################################################################################
*/
var hostname = document.getElementById("hostname").value;
var username = document.getElementById("administrator").value;
var password = document.getElementById("mdp").value;
var modele = document.getElementById("modele").selectedIndex;
var ipaddress = document.getElementById("ipaddress").value;
var mask = document.getElementById("mask").value;
var gateway = document.getElementById("gateway").value;
var dns = document.getElementById("dns").value;
var sntp = document.getElementById("sntp").value;
var sipserverIP = document.getElementById("sipserverIP").value;
var sipserverPort = document.getElementById("sipserverPort").value;
var sipserverLogin = document.getElementById("sipserverLogin").value;
var sipserverPassword = document.getElementById("sipserverPassword").value;
var l2protocol = document.getElementById("l2protocol").value;
var incallform = document.getElementById("incallform").selectedIndex;
var outcallform = document.getElementById("outcallform").selectedIndex;
var canauxt2 = document.getElementById("canauxt2").value;
var canauxt2champ = document.getElementById("canauxt2").value;
var formulaire = document.getElementById("formulaire");

function recup_valeur() {
	hostname = document.getElementById("hostname").value;
	username = document.getElementById("administrator").value;
	password = document.getElementById("mdp").value;
	modele = document.getElementById("modele").selectedIndex;
	ipaddress = document.getElementById("ipaddress").value;
	mask = document.getElementById("mask").value;
	gateway = document.getElementById("gateway").value;
	dns = document.getElementById("dns").value;
	sntp = document.getElementById("sntp").value;
	sipserverIP = document.getElementById("sipserverIP").value;
	sipserverPort = document.getElementById("sipserverPort").value;
	sipserverLogin = document.getElementById("sipserverLogin").value;
	sipserverPassword = document.getElementById("sipserverPassword").value;
	l2protocol = document.getElementById("l2protocol").value;
	incallform = document.getElementById("incallform").selectedIndex;
	outcallform = document.getElementById("outcallform").selectedIndex;
	canauxt2 = document.getElementById("canauxt2").value;
	canauxt2champ = document.getElementById("canauxt2").value;
}


/*
###################################################################################
#                                    FONCTIONS                                    #
###################################################################################
*/

function changementModele() {
	//Récupération du modèle
	modele = document.getElementById("modele").selectedIndex;
	if (modele == 1 || modele == 4) {
		canauxt2champ.disabled = false;
	}
	else {
		canauxt2champ.disabled = true;
	}
}

function generer() {
	recup_valeur();
	var dhcp = false;

	//Vérification du nom
	if(hostname == ""){
		alert("Vous n'avez pas renseigné de nom !");
		return;
	}

	//Vérification de nom d'utilisateur administrateur
	if(username == ""){
		alert("Vous n'avez pas renseigné de nom d'utilisateur administrateur !");
		return;
	}

	//Vérification du mot de passe administrateur
	if(password == ""){
		alert("Vous n'avez pas renseigné de mot de passe administrateur !");
		return;
	}

	//Vérification de l'adresse IP
	if(ipaddress.toLowerCase == "dhcp" || ipaddress.length <= 15){
		if(ipaddress.toLowerCase() == "dhcp"){
			dhcp = true;
		}
	}
	else{
		alert("Vous n'avez pas ou mal rensigné l'adresse IP !");
		return;
	}

	//Vérification du masque
	if(mask == "" && dhcp != true){
		alert("Vous n'avez pas renseigné le masque !");
		return;
	}

	//Vérification de la gateway
	if(gateway == "" && dhcp != true){
		alert("Vous n'avez pas renseigné de gateway !");
		return;
	}

	//Vérification des DNS
	if(dns == "" && dhcp != true){
		alert("Vous n'avez pas renseigné de serveur DNS !");
		return;
	}

	//Vérification de la SNTP
	if(sntp == "" && dhcp != true){
		alert("Vous n'avez pas renseigné de serveur SNTP !");
		return;
	}

	//Vérification du serveur SIP
	if(sipserverIP == ""){
		alert("Vous n'avez pas renseigné de serveur SIP !");
		return;
	}

	//Vérification du Port SIP
	if(sipserverPort == ""){
		alert("Vous n'avez pas renseigné de port pour le serveur SIP !");
		return;
	}

	//Vérification du username SIP
	if(sipserverLogin == ""){
		alert("Vous n'avez pas renseigné de nom d'utilisateur SIP !");
		return;
	}

	//Vérification du mot de passe SIP
	if(sipserverPassword == ""){
		alert("Vous n'avez pas renseigné de mot de passe SIP !");
		return;
	}

	//Vérification des canaux T2
	if((modele == 1 || modele == 4) && canauxt2 == ""){
		alert("Vous n'avez pas renseigné le nombre de canaux T2 !");
		return;
	}

	//Submit du formulaire
	formulaire.submit();
}


/*
###################################################################################
#                               PARAMETRES DE BASE                                #
###################################################################################
*/

changementModele();