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
						<li class="selected"><a href="gestionclient.php">Clients</a></li>
						<li><a href="gestionproduit.php">Produits</a></li>
						<li><a href="index.php">Deconnexion</a></li>
					</ul>
					
				</div>
				
			</div>
			<div id="banniere">
				<img src="images/home.jpg" width="900" height="300">
			</div>
				
				
					<div class="formulaire">
						<h1>Gestion des clients!<span>Ajoutez et consultez la liste des clients.</span></h1>
						</br></br></br>
						<h2>Ajoutez un client</h2>	
							<form action="" method="POST">
								<div class="section">Nom, Prenom &amp; Contacts du client</div>
									<div class="inner-wrap">									
									<center>
										<label>Nom <input type="text" name="field1" /></label>
										<label>Prenom <input type="text" name="field2" /></label>
										<label>Jour 
											<select name="field3">
												<option>/-----/</option>
											<?php
												for ($i=1;$i<=31;$i++)
												{
													echo '<option>'.$i.'</option>';
												}	
											?>
											</select>
										</label>
										<label>Mois 
											<select name="field4">
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
											<select name="field5" >
											<option>/-----/</option>
											<?php
												for ($i=1990;$i<=2017;$i++)
												{
													echo '<option>'.$i.'</option>';
												}	
											?>
											</select>
										</label>
										<label>Contacts <input type="text" name="field6" /></label>
									<center>
									</div>
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
										$nom=$_POST['field1'];
										$prenom=$_POST['field2'];
										$jour=$_POST['field3'];
										$mois=$_POST['field4'];
										$annee=$_POST['field5'];
										$tel=$_POST['field6'];
										
										/*insertion dans la base de données*/
										
										//requête
										$sql="INSERT INTO clients 
													 VALUES(NULL,'".$nom."','".$prenom."','".$jour."',
															'".$mois."','".$annee."','".$tel."')";
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
										<h2>Liste des clients</h2>
										<thead>
											<tr>
												<th>ID</th>
												<th>Nom</th>
												<th>Prenom</th>
												<th>Date de naissance</th>
												<th>Contacts</th>
											</tr>
										</thead>
										<tbody>
											<?php
												
												
												/*afficher la liste des clients*/
												
												//requête 
												$sql="SELECT * FROM clients";
												
												//exécution (on met le résultat dans une variable)
												$res=mysqli_query($con,$sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
												
												//on met le résultat sous forme de tableau
												while ($data=mysqli_fetch_array($res))
												{
													$id=$data['IdClient'];
													$nom=$data['NomClient'];
													$prenom=$data['PrenomClient'];
													$jour=$data['JourNaissance'];
													$mois=$data['MoisNaissance'];
													$annee=$data['AnneeNaissance'];
													$tel=$data['TelephoneClient'];
												
													echo '<tr>
															<td>'.$id.'</td>
															<td>'.$nom.'</td>
															<td>'.$prenom.'</td>
															<td>'.$jour.' '.$mois.' '.$annee.'</td>
															<td>'.$tel.'</td>
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
