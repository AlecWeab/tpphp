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
					<h1>Gestion des commandes!<span>Passez une commande et consultez la liste des commandes.</span></h1>
					</br></br></br>
						<h2>Passez une commande</h2>	
						<form action="" method="POST">
							<div class="section">Mois, Année &amp; Client (commande)</div>
							<div class="inner-wrap">
							<center>
								<label>Mois 
											<select name="field1">
												<option>/-----/</option>
												<option>Janvier</option>
												<option>Fevrier</option>
												<option>Mars</option>
												<option>Avril</option>
												<option>Mai</option>
												<option>Juin</option>
												<option>Juillet</option>
												<option>Août</option>
												<option>Septembre</option>
												<option>Octobre</option>
												<option>Novembre</option>
												<option>Decembre</option>
											</select>
										</label> 
										<label>Annee 
											<select name="field2" >
											<option>/-----/</option>
											<?php
												for ($i=1990;$i<=2017;$i++)
												{
													echo '<option>'.$i.'</option>';
												}	
											?>
											</select>
										</label>
								<label>Client
									<select name="field3">
									<option>/-----/</option>
										<?php
											/*récupération de l'id du client dans la bdd avec le nom du client*/
											
											//requête
											$sql="SELECT * FROM clients";
											
											//execution (on met le résultat dans une variable)
											$res=mysqli_query($con,$sql) or die ('Erreur SQL!'.$sql.'<br/>'.mysqli_error($con));
											
											//récupération et mise des données dans un tableau
											while ($data=mysqli_fetch_array($res))
											{
												$id=$data['IdClient'];
												$nom=$data['NomClient'];
												$prenom=$data['PrenomClient'];
												
												echo'<option value='.$id.' >'.$nom.' '.$prenom.'</option>';
											}
											
										?>
									</select>
								</label>
							</center>

							<div class="button-section">
								<input type="submit" name="Enregister" />
								<input type="reset" name="Annuler" /> 
							</div>
							
							<?php 
									/*enregistrer un client*/
									if (isset($_POST['Enregister']))
									{
										$mois=$_POST['field1'];
										$annee=$_POST['field2'];
										$idc=$_POST['field3'];
										
										/*insertion dans la base de données*/
										
										//requête
										$sql="INSERT INTO commandes 
													 VALUES(NULL,'".$mois."','".$annee."','".$idc."')";
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
										<h2>Liste des commandes</h2>
										<thead>
											<tr>
												<th>ID</th>
												<th>Mois</th>
												<th>Annee</th>
												<th>Client</th>
											</tr>
										</thead>
										<tbody>
											<?php
												
												
												/*afficher la liste des clients*/
												
												//requête 
												$sql="SELECT * FROM commandes";
												
												//exécution (on met le résultat dans une variable)
												$res=mysqli_query($con,$sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error($con));
												
												//on met le résultat sous forme de tableau
												while ($data=mysqli_fetch_array($res))
												{
													$id=$data['IdCommande'];
													$mois=$data['MoisCommande'];
													$annee=$data['AnneCommande'];
													$idc=$data['NumClient'];
												
													$sql1="SELECT NomClient, PrenomClient 
														  FROM clients
														  WHERE IdClient='".$idc."'";
														  
													$res1=mysqli_query($con,$sql1) or die ('Erreur SQL!'.$sql1.'<br/>'.mysqli_error($con));
													
													if ($data1=mysqli_fetch_array($res1))
													{
														
														$nom1=$data1['NomClient'];
														$prenom1=$data1['PrenomClient'];
																											
														echo '<tr>
																<td>'.$id.'</td>
																<td>'.$mois.'</td>
																<td>'.$annee.'</td>
																<td>'.$nom1.' '.$prenom1.'</td>
																<td><a href="detailcommande.php?id='.$id.'"> Détailler </a>
															  </tr>';
														
													}
												}
											?>
										</tbody>
									</table>
								</center> 
						</form>
				</div>
				
			</div>
			
			<div id="footer">
				<p> Copyright &copy; GESTION GIE-CPC| designed by Alec Weab </p> 
			</div>
		</div>
	</body>
</html>
