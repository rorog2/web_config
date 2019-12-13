<?php
$version = "v1.0beta"
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Configuration Mikrotik <?= $version ?></title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="images/gto.png" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<main>
			<h1>Configuration Mikrotik <?= $version ?></h1>
			<form action="index.php" method="post">
				<fieldset>
					<legend>Informations de base</legend>
					<p>
						<label for="nom">Nom du routeur: </label>
						<input type="text" name="nom" id="nom">
					</p>
					<p>
						<label for="cesoUser">Utilisateur CESO: </label>
						<input type="text" name="cesoUser" id="cesoUser" value="ceso">
						<input type="text" name="cesoMDP" id="cesoMDP" value="isx@3009">
					</p>
					<p>
						<label for="localUser">Utilisateur local: </label>
						<input type="text" name="localUser" id="localUser" value="client">
						<input type="text" name="localMDP" id="localMDP" value="ceso-admin">
					</p>
				</fieldset>
				<fieldset>
					<legend>Configuration des interfaces</legend>
					<p>
						<label for="modele">Modèle du routeur: </label>
						<select name="modele" id="modele">
							<option value="hex-rb750gr3">0 - hEX RB750Gr3</option>
							<option value="rb951">1 - RB951</option>
							<option value="rb3011-uias-rm">2 - RB3011 UiAS-RM</option>
						</select>
					</p>
					<p>
						<label for="nbLAN">Nombre de LAN: </label>
						<input type="number" name="nbLAN" id="nbLAN" min="1" max="2" value="1">
					</p>
					<p>
						<table>
							<!-- <caption>Assignation des interfaces</caption> -->
							<tr>
								<th></th>
								<th>LAN 1</th>
								<th>LAN 2</th>
							</tr>
							<?php for($i=2; $i <= 10; $i++) : ?>
							<tr>
								<td><?= $i ?></td>
								<td>
									<input type="checkbox" name="1<?= $i ?>" id="1<?= $i ?>" class="lan1" />
								</td>
								<td>
									<input type="checkbox" name="2<?= $i ?>" id="2<?= $i ?>" class="lan2" />
								</td>
							</tr>
							<?php endfor; ?>
						</table>
					</p>
					<p>
						<label for="SSID">SSID: </label>
						<input type="text" name="ssid" id="ssid" />
					</p>
					<p>
						<label for="psk">PSK: </label>
						<input type="text" name="psk" id="psk" />
					</p>
				</fieldset>
				<fieldset>
					<legend>Assignation des adresses IP</legend>
					<p>
						<label for="ipclient">IP Client: </label>
						<input class="ip" type="text" name="ipclient1" id="ipclient1" /> .
						<input class="ip" type="text" name="ipclient2" id="ipclient2" /> .
						<input class="ip" type="text" name="ipclient3" id="ipclient3" /> .
						<input class="ip" type="text" name="ipclient4" id="ipclient4" /> /
						<input class="ip" type="number" name="masque" id="masque" min="25" max="31" value="31" />
					</p>
					<p>
						<label for="ipclient">IP Gateway: </label>
						<input class="ip" type="text" name="ipgateway1" id="ipgateway1" /> .
						<input class="ip" type="text" name="ipgateway2" id="ipgateway2" /> .
						<input class="ip" type="text" name="ipgateway3" id="ipgateway3" /> .
						<input class="ip" type="text" name="ipgateway4" id="ipgateway4" />
					</p>
				</fieldset>
				<p>
					<button type="button" id="generer">
						<img src="images/valider.png" alt="valider" /> Générer
					</button>
				</p>
			</form>
		</main>
		<script type="text/javascript" src="js/main.js"></script>
		<noscript>Désoler, votre navigateur ne supporte pas le JavaScript !</noscript>
	</body>
</html>