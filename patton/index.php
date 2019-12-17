<?php
$version = "v1.0beta"
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
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
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
						<legend>Paramètres</legend>
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
					</fieldset>
					<fieldset>
						<legend>Paramètres IP et @IP eth0/0</legend>
					</fieldset>
					<p>
						<center>
							<button type="button" id="generer" class="btn btn-primary">
								Générer
							</button>
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