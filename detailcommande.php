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
					<h1><a href="index.php">Gestion<span class="nom_tp">GIE-CPC</span></a></h1>
				</div>
				
				<div id="menubar">
					<ul id="menu">
						<li class="selected"><a href="gestioncommande.php">Passer Commande</a></li>
						<li><a href="etatcommande.php">Afficher Commande</a></li>
						<li><a href="gestionclient.php">Clients</a></li>
						<li><a href="gestionproduit.php">Produits</a></li>
						<li><a href="index.php">Deconnexion</a></li>
					</ul>
					</br>
					</br>
				</div>
				
			</div>
			<div id="contenu_site">
				
				<div id="banniere">
					<img src="images/office-1448219_1920.jpg" width="900" height="300">
				</div>
				
				<div class="formulaire">
					<h1>Details des commandes!<span></h1>
					</br></br></br>
						<h2>Enregister les détails</h2>	
						<form action="" method="POST">
							<div class="section">Mois, Année &amp; Client (commande)</div>
							<div class="inner-wrap">
							<center>
							<label>Commande
							<?php
							/*récupération de l'id de la commande dans le get*/
							$idcom=$_GET['id'];
							echo'<input type="text" value='.$idcom.' disabled="true"/>';
							?> 
										</label> 
										<label>Produit 
											<select name="field2" >
											<option>/-----/</option>
											<?php
											/*récupération de l'id du produit dans la bdd avec le nom du client*/
											
											//requête
											$sql="SELECT * FROM produits";
											
											//execution (on met le résultat dans une variable)
											$res=mysqli_query($con,$sql) or die ('Erreur SQL!'.$sql.'<br/>'.mysqli_error($con));
											
											//récupération et mise des données dans un tableau
											while ($data=mysqli_fetch_array($res))
											{
												$id=$data['IdProduit'];
												$lib=$data['LibProduit'];
												
												echo'<option value='.$id.'>'.$lib.'</option>';
											}
											?>
											</select>
										</label>
								<label>Quantité <input type="text" name="field3"/></label>
							</center>
							<div class="button-section">
								<input type="submit" name="Enregister" />
								<input type="reset" name="Annuler" /> 
							</div>
							
							<?php 
									/*enregistrer un client*/
									if (isset($_POST['Enregister']))
									{
										$idcom=$_GET['id'];
										$idp=$_POST['field2'];
										$qte=$_POST['field3'];
										
										/*insertion dans la base de données*/
										
										//requête
										$sql="INSERT INTO details
													 VALUES('".$idcom."','".$idp."','".$qte."')";
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
										<h2>Liste des details de commandes</h2>
										<thead>
											<tr>
												<th>Commande</th>
												<th>Produit</th>
												<th>Quantité</th>
											</tr>
										</thead>
										<tbody>
											<?php
												/*afficher la liste des clients*/
												
												//requête 
												$sql1="SELECT * FROM details";
												
												//exécution (on met le résultat dans une variable)
												$res1=mysqli_query($con,$sql1) or die ('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error($con));
												
												//on met le résultat sous forme de tableau
												while ($data1=mysqli_fetch_array($res1))
												{
													$idcom=$data1['NumCommande'];
													$idp=$data1['NumProduit'];
													$qte=$data1['Qte'];
													
													//je veux afficher le libellé produit et son prix unitaire
													$sql2="SELECT LibProduit, PrixUnitaireProduit 
														  FROM produits
														  WHERE IdProduit='".$idp."'";
														  
													$res2=mysqli_query($con,$sql2) or die ('Erreur SQL!'.$sql2.'<br/>'.mysqli_error($con));
													
													if ($data2=mysqli_fetch_array($res2))
													{
														$lib=$data2['LibProduit'];
														$pu=$data2['PrixUnitaireProduit'];
														
													
													echo '<tr>
															<td>'.$idcom.'</td>
															<td>'.$lib.' '.$pu.'FCFA</td>
															<td>'.$qte.'</td>
														  </tr>';
													}
												}
											?>
										</tbody>
									</table>
								</center> 
						</form>
						<a href="gestioncommande.php">Retour</a>
				</div>
				
			</div>
			
			<div id="footer">
				<p> Copyright &copy; GESTION GIE-CPC| designed by Alec Weab </p> 
			</div>
		</div>
	</body>
</html>
