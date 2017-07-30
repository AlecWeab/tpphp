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
					<h1><a href="index.php">Gestion<span class="nom_tp">GIE-CPC</span></a></h1>
				</div>
				
				<div id="menubar">
					<ul id="menu">
						<li><a href="gestioncommande.php">Passer Commande</a></li>
						<li><a href="etatcommande.php">Afficher Commande</a></li>
						<li><a href="gestionclient.php">Clients</a></li>
						<li class="selected"><a href="gestionproduit.php">Produits</a></li>
						<li><a href="index.php">Deconnexion</a></li>
					</ul>
					
				</div>
				
			</div>
			<div id="banniere">
				<img src="images/promotional.jpg" width="900" height="300">
			</div>
				
				
					<div class="formulaire">
						<h1>Gestion des produits!<span>Ajoutez et consultez la liste des produits.</span></h1>
						</br></br></br>
						<h2>Ajoutez un produit</h2>	
							<form action="" method="POST">
								<div class="section">Libelle &amp; prix unitaire du client</div>
									<center>
									<div class="inner-wrap">									
										<label>Libelle <input type="text" name="field1" /></label>
										<label>Prix unitaire <input type="text" name="field2" /></label> 
									</div>
									</center>
									<div class="button-section">
										<input type="submit" name="Enregister" />
										<input type="reset" name="Annuler" /> 
									</div>
								<?php
									/*connexion à la base de donnée*/
									$bdd="gie";
									$con= mysqli_connect('localhost','root','');

									// test la connection 
									if ( ! $con ) 
										die ("connection impossible"); 
										// Connecte la base 
										mysqli_select_db($con,$bdd) or die ("pas de connection"); 

									/*enregistrer un client*/
									if (isset($_POST['Enregister']))
									{
										$lib=$_POST['field1'];
										$pu=$_POST['field2'];
										
										/*insertion dans la base de données*/
										
										//requête
										$sql="INSERT INTO produits 
													 VALUES(NULL,'".$lib."','".$pu."')";
										//exécution
										mysqli_query($con,$sql) or die ('Erreur SQL!'.$sql.'<br/>'.mysqli_error($con));
										echo 'Ajout terminé !! <br /><br />';
									}
								?>
								</br>
								</br>
								</br>
								</br>
								</br>
								<center>
									<table>
										<h2>Liste des produits</h2>
										<thead>
											<tr>
												<th>ID</th>
												<th>Libelle</th>
												<th>Prix Unitaire</th>
											</tr>
										</thead>
										<tbody>
											<?php
												
												
												/*afficher la liste des clients*/
												
												//requête 
												$sql="SELECT * FROM produits";
												
												//exécution (on met le résultat dans une variable)
												$res=mysqli_query($con,$sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
												
												//on met le résultat sous forme de tableau
												while ($data=mysqli_fetch_array($res))
												{
													$id=$data['IdProduit'];
													$lib=$data['LibProduit'];
													$pu=$data['PrixUnitaireProduit'];
												
													echo '<tr>
															<td>'.$id.'</td>
															<td>'.$lib.'</td>
															<td>'.$pu.'FCFA</td>
														  </tr>';
												}
											?>
										</tbody>
									</table>
								</center> 
							</form>
					</div>
			
			<div id="footer">
				<p> Copyright &copy; GESTION GIE-CPC| designed by Alec Weab </p> 
			</div>
		</div>
	</body>
</html>
