<?php
$version = "v1.0beta1";

if(isset($_GET['download'])){
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=config.rsc;');
	header('Content-Length: '.filesize('config.rsc'));
	readfile('config.rsc');
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Configuration Mikrotik <?= $version ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../images/gto.png" />
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
		<header class="page-header">
			<div class="col-sm-12">
				<h1><img alt="Logo GTO" src="../images/gto.png" />Configuration Mikrotik <?= $version ?></h1>
			</div>
		</header>
		<div class="row">
			<aside class="col-sm-3">
			</aside>
			<main class="col-sm-6">
				<form action="config.php" method="post" id="formulaire">
					<fieldset>
						<legend>Informations de base</legend>
						<p>
							<label for="nom">Nom du routeur: </label>
							<input type="text" name="nom" id="nom" class="form-control">
						</p>
						<p>
							<label for="cesoUser">Utilisateur CESO: </label>
							<input type="text" name="cesoUser" id="cesoUser" value="gto" class="form-control">
							<input type="text" name="cesoMdp" id="cesoMdp" value="isx@3009" class="form-control">
						</p>
						<p>
							<label for="localUser">Utilisateur local: </label>
							<input type="text" name="localUser" id="localUser" value="client" class="form-control">
							<input type="text" name="localMdp" id="localMdp" value="gto-admin" class="form-control">
						</p>
					</fieldset>
					<fieldset>
						<legend>Configuration des interfaces</legend>
						<p>
							<label for="modele">Modèle du routeur: </label>
							<select name="modele" id="modele" class="form-control">
								<option value="hex-rb750gr3">0 - hEX RB750Gr3</option>
								<option value="rb951">1 - RB951</option>
								<option value="rb3011-uias-rm">2 - RB3011 UiAS-RM</option>
							</select>
						</p>
						<p>
							<label for="nbLAN">Nombre de LAN: </label>
							<input type="number" name="nbLAN" id="nbLAN" min="1" max="2" value="1" class="form-control">
						</p>
						<p>
							<table class="table table-bordered table-striped">
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
										<input type="checkbox" name="e1<?= $i ?>" id="1<?= $i ?>" class="form-control checkbox" />
									</td>
									<td>
										<input type="checkbox" name="e2<?= $i ?>" id="2<?= $i ?>" class="form-control checkbox" />
									</td>
								</tr>
								<?php endfor; ?>
							</table>
						</p>
						<p>
							<label for="nat">NAT: </label>
							<input type="checkbox" name="nat" id="nat" checked  class="form-control checkbox"/>
						</p>
						<p>
							<label for="SSID">SSID: </label>
							<input type="text" name="ssid" id="ssid"  class="form-control"/>
						</p>
						<p>
							<label for="psk">PSK: </label>
							<input type="text" name="psk" id="psk"  class="form-control"/>
						</p>
					</fieldset>
					<fieldset>
						<legend>Assignation des adresses IP</legend>
						<p>
							<label for="ipclient">IP Client: </label>
							<input class="ip" type="text" name="ipclient1" id="ipclient1" class="form-control ip" /> .
							<input class="ip" type="text" name="ipclient2" id="ipclient2" class="form-control ip" /> .
							<input class="ip" type="text" name="ipclient3" id="ipclient3" class="form-control ip" /> .
							<input class="ip" type="text" name="ipclient4" id="ipclient4" class="form-control ip" /> /
							<input class="ip" type="number" name="masque" id="masque" min="25" max="31" value="31"  class="form-control ip" />
						</p>
						<p>
							<label for="ipclient">IP Gateway: </label>
							<input class="ip" type="text" name="ipgateway1" id="ipgateway1" class="form-control ip" /> .
							<input class="ip" type="text" name="ipgateway2" id="ipgateway2" class="form-control ip" /> .
							<input class="ip" type="text" name="ipgateway3" id="ipgateway3" class="form-control ip" /> .
							<input class="ip" type="text" name="ipgateway4" id="ipgateway4" class="form-control ip" />
						</p>
					</fieldset>
					<p>
						<center>
							<button type="button" id="generer" class="btn btn-primary">
								<span class="glyphicon glyphicon-ok-sign"></span>
								Générer
							</button>
							<a href="parametres.txt" target="_blank">
								<button type="button" id="generer" class="btn btn-warning">
									Vérifier les paramètres
								</button>
							</a>
							<a href="../index.php">
								<button type="button" id="generer" class="btn btn-danger">
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
		<script type="text/javascript" src="js/hex-rb750gr3.js"></script>
		<script type="text/javascript" src="js/rb951.js"></script>
		<script type="text/javascript" src="js/rb3011-uias-rm.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<noscript>Désoler, votre navigateur ne supporte pas le JavaScript !</noscript>
	</body>
</html>