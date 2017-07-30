<?php
	/*connexion à la base de donnée*/
									$bdd="gie";
									$con= mysqli_connect('localhost','root','');

									// test la connection 
									if ( ! $con ) 
										die ("connection impossible"); 
										// Connecte la base 
										mysqli_select_db($con,$bdd) or die ("pas de connection"); 

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> GIE </title>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
	</head>
	<body>

		<div id="principal">	
			<div id="header">
				<div id="ntp">
				<!-- class="nom_tp"pour changer la couleur du texte du nom de l'université -->
					<h1><a href="index.html">Gestion<span class="nom_tp">GIE-CPC</span></a></h1>
				</div>
				
			</div>

				<div id="banniere">
					<img src="images/banniere_conn.jpg" width="900" height="300">
				</div>

					<div class="formulaire">
						<h1>IDENTIFIEZ VOUS !<span>Identifiez vous pour avoir accès à la plateforme de gestion de GIE-CPC</span></h1>
							<form action="" method="POST">
								<div class="section">Connexion </div>
								<div class="inner-wrap">
									<center>
									<label>Identifiant<input type="text" name="field1" /></label>
									<label>Mot de passe <input type="password" name="field2" /></label>
									</center>
								</div>
								<div class="button-section">
									<input type="submit" name="Connexion" />
									<input type="reset" name="Annuler" /> 
								</div>
								<?php
									if (isset($_POST['Connexion']))
									{
										$id=$_POST['field1'];
										$mdp=$_POST['field2'];
										
										//requete de vérification
										$sql="SELECT NomUser, MdpUser
											  FROM users 
											  WHERE NomUser='".$id."' and MdpUser='".$mdp."'
											  ";
										//execution de la requete
										$req=mysqli_query($con,$sql) or die ('Erreur SQL!'.$sql.'<br/>'.mysqli_error($con));
										
										if ($req)
										{
											header('location:gestioncommande.php');
										}
										else 
										{
											echo'identifiant ou mot de passe incorrect veuillez recommencer svp!!!';
										}
									}
								?>
							</form>
					</div>
				
			<div id="footer">
				
				<p> Copyright &copy; GESTION GIE-CPC| designed by Alec Weab </p> 
					 
			</div>
		</div>
	</body>
</html>
