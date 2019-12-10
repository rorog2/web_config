<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Configuration Mikrotik</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<main>
			<h1>Configuration Mikrotik</h1>
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
				</fieldset>
			</form>
		</main>
	</body>
</html>