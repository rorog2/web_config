<?php
$version = "v1.0beta1";

//Téléchargement de la configuration
if(isset($_GET['download'])){
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=config.cfg;');
	header('Content-Length: '.filesize('config.cfg'));
	readfile('config.cfg');
	header('Location: index.php?download');
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Configuration Patton <?= $version ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../images/gto.png" />
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
	</head>
	<body>
		<header class="page-header">
			<div class="col-sm-12">
				<h1><img alt="Logo GTO" src="../images/gto.png" />Configuration Patton <?= $version ?></h1>
			</div>
		</header>
		<div class="row">
			<aside class="col-sm-3">
			</aside>
			<main class="col-sm-6">
				<form action="config.php" method="post" id="formulaire">
					<fieldset>
						<legend>Paramètres de base</legend>
						<p>
							<label for="hostname">Hostname: </label>
							<input type="text" name="hostname" id="hostname" class="form-control" placeholder="Nom de l'équipement..." />
						</p>
						<p>
							<label for="administrator">Administrateur: </label>
							<input type="text" name="administrator" id="administrator" class="form-control" placeholder="Nom d'utilisateur du compte administrateur..." />
						</p>
						<p>
							<label for="mdp">Mot de passe: </label>
							<input type="text" name="mdp" id="mdp" class="form-control" placeholder="Mot de passe du compte administrateur..." />
						</p>
						<p>
							<label for="modele">Modèle: </label>
							<select name="modele" id="modele" class="form-control">
								<option value="4131">4131</option>
								<option value="4171">4171</option>
								<option value="4634">4636</option>
								<option value="4638">4638</option>
								<option value="4970">4970</option>
							</select>
						</p>
					</fieldset>
					<fieldset>
						<legend>Paramètres IP et @IP eth0/0</legend>
						<p>
							<label for="ipaddress">Adresse IP: </label>
							<input type="text" name="ipaddress" id="ipaddress" class="form-control" placeholder="Taper 'dhcp' ou l'@IP..." />
						</p>
						<p>
							<label for="mask">Masque: </label>
							<input type="text" name="mask" id="mask" class="form-control" placeholder="Pas utiliser si dhcp..." />
						</p>
						<p>
							<label for="gateway">Passerelle par défaut: </label>
							<input type="text" name="gateway" id="gateway" class="form-control" placeholder="Pas utiliser si dhcp..." />
						</p>
						<p>
							<label for="dns">Serveur DNS: </label>
							<input type="text" name="dns" id="dns" class="form-control" placeholder="Pas utiliser si dhcp..." />
						</p>
						<p>
							<label for="sntp">Serveur SNTP: </label>
							<input type="text" name="sntp" id="sntp" class="form-control" placeholder="Pas utiliser si dhcp..." />
						</p>
					</fieldset>
					<fieldset>
						<legend>Paramètres SIP</legend>
						<p>
							<label for="sipserverIP">Serveur SIP ou FQDN: </label>
							<input list="sipserverlist" type="text" id="sipserverIP" name="sipserverIP" class="form-control" placeholder="Domaine ou ip registrar...">
							<datalist id="sipserverlist">
								<option value="sip.openvno.net">
								<option value="sip2.openvno.net">
								<option value="sip3.openvno.net">
							</datalist>
						</p>
						<p>
							<label for="sipserverPort">Port serveur SIP: </label>
							<input type="text" name="sipserverPort" id="sipserverPort" class="form-control" placeholder="Port par défaut 5060..." />
						</p>
						<p>
							<label for="sipserverLogin">Nom d'utilisateur SIP: </label>
							<input type="text" name="sipserverLogin" id="sipserverLogin" class="form-control" placeholder="Login SIP..." />
						</p>
						<p>
							<label for="sipserverPassword">Mot de passe SIP: </label>
							<input type="text" name="sipserverPassword" id="sipserverPassword" class="form-control" placeholder="Password SIP..." />
						</p>
					</fieldset>
					<fieldset>
						<legend>Paramètres BRI</legend>
						<p>
							<label for="l2protocol">Protocole de couche 2: </label>
							<select name="l2protocol" id="l2protocol" class="form-control">
								<option value="pp" selected>pp</option>
								<option value="pmp">pmp</option>
							</select>
						</p>
						<p>
							<label for="incallform">Format d'appel entrant: </label>
							<select name="incallform" id="incallform" class="form-control">
								<option value="4">4 chiffres</option>
								<option value="9">9 chiffres</option>
								<option value="10" selected>10 chiffres</option>
							</select>
						</p>
						<p>
							<label for="outcallform">Format d'appel sortant (CLIP): </label>
							<select name="outcallform" id="outcallform" class="form-control">
								<option value="9">9 chiffres</option>
								<option value="10" selected>10 chiffres</option>
							</select>
						</p>
					</fieldset>
					<fieldset>
						<legend>Paramètres PRI</legend>
						<p>
							<label for="canauxt2">Nombre de canaux T2: </label>
							<input type="text" name="canauxt2" id="canauxt2" class="form-control" value="15" placeholder="Max 15 ou 30..." />
						</p>
					</fieldset>
					<p>
						<center>
							<button type="button" id="generer" class="btn btn-primary">
								Générer
							</button>
							<a href="parametres.txt" target="_blank">
								<button type="button" class="btn btn-warning">
									Vérifier les paramètres
								</button>
							</a>
							<a href="../index.php">
								<button type="button" class="btn btn-danger">
									Retour vers l'acceuil
								</button>
							</a>
						</center>
					</p>
				</form>
			</main>
			<aside class="col-sm-3">
			</aside>
		</div>
		<footer class="row">
        	<div class="col-sm-12">
        		
        	</div>
      	</footer>
		<script type="text/javascript" src="js/main.js"></script>
		<noscript>Désoler, votre navigateur ne supporte pas le JavaScript !</noscript>
	</body>
</html>