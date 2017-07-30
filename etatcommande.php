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

<script src="export2excel/src/jquery.table2excel.js"></script>
	
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
						<li class="selected"><a href="etatcommande.php">Afficher Commande</a></li>
						<li><a href="gestionclient.php">Clients</a></li>
						<li><a href="gestionproduit.php">Produits</a></li>
						<li><a href="index.php">Deconnexion</a></li>
					</ul>
					
				</div>
				
			</div>
			<div id="banniere">
				<img src="images/etatcommande.jpg" width="900" height="300">
			</div>
				
				
					<div class="formulaire">
						<h1>Afficher une commande!</h1>
							<form action="" method="POST">
								<div class="section">Entrez le numero d'une commande</div>
									<center>
									<div class="inner-wrap">									
										<label>ID Commande <input type="text" name="field1" /></label> 
									</div>
									</center>
									<div class="button-section">
										<input type="submit" name="Enregister" />
									</div>
								<?php
									/*enregistrer un client*/
									if (isset($_POST['Enregister']))
									{
										$idcom=$_POST['field1'];
										
										//requête
										$sql="SELECT * FROM commandes";
										
										$query="SELECT * FROM details 
												WHERE NumCommande='".$idcom."'";
										//exécution
										$req=mysqli_query($con,$sql) or die ('Erreur SQL!'.$sql.'<br/>'.mysqli_error($con));
										
										//execute query
										$res=mysqli_query($con,$query) or die ('Erreur SQL!'.$query.'<br/>'.mysqli_error($con));
										
										//mise des résultats dans un tableau
										if ($data=mysqli_fetch_array($req))
										{
											$idc=$data['NumClient'];
											$mois=$data['MoisCommande'];
											$annee=$data['AnneCommande'];
									
											//requet1
											$sql1="SELECT NomClient, PrenomClient, TelephoneClient
													FROM clients
													WHERE IdClient='".$idc."'";
													
											//execution1
											$req1=mysqli_query($con,$sql1) or die ('Erreur SQL!'.$sql1.'<br/>'.mysqli_error($con));
											if ($data1=mysqli_fetch_array($req1))
											{
												$nom=$data1['NomClient'];
												$prenom=$data1['PrenomClient'];
												$tel=$data1['TelephoneClient'];
												
												//début
												echo'</br>
													</br></br>
												<center>
												<h2>Commande n°BC00'.$idcom.'</h2>
												<label> Mois Commande <input type="text" value='.$mois.' disabled="true"/>';
												echo'
												<label> Annee Commande <input type="text" value='.$annee.' disabled="true"/>';
												
												echo'
												<label> Nom Client <input type="text" value='.$nom.' disabled="true"/>';
												echo'
												<label> Prenom Client <input type="text" value='.$prenom.' disabled="true"/>';
												echo'
												<label> Telephone Client <input type="text" value='.$tel.' disabled="true"/>';
												
												echo'</br>
														</br>
														<center>
														<table>
															<h2>Liste des produits</h2>
															<thead>
																<tr>
																	<th>Libelle</th>
																	<th>Prix Unitaire</th>
																	<th>Quantite</th>
																	<th>Total</th>
																</tr>
															</thead>';
												//suite dans un while
												$total2=0;
												while ($data3=mysqli_fetch_array($res))
												{
													$idp=$data3['NumProduit'];
													$qte=$data3['Qte'];
													
													//je veux afficher le libellé produit et son prix unitaire
													$sql4="SELECT LibProduit, PrixUnitaireProduit 
														  FROM produits
														  WHERE IdProduit='".$idp."'";
														  
													$res4=mysqli_query($con,$sql4) or die ('Erreur SQL!'.$sql4.'<br/>'.mysqli_error($con));
													
													if ($data4=mysqli_fetch_array($res4))
													{
														$lib=$data4['LibProduit'];
														$pu=$data4['PrixUnitaireProduit'];
														
														//total par ligne
														$total=$qte*$pu;
														//affichage
													echo'<tbody>
															<tr>
															<td>'.$lib.'</td>
															<td>'.$pu.'FCFA</td>
															<td>'.$qte.'</td>
															<td>'.$total.'FCFA</td>
														  </tr>
														 <tbody>';
														
														$total2=$total2+$total;
													}
												}
												echo'<tfoot>
														<tr>
														  <th colspan="3">Grand Total</th>
														  <th>'.$total2.'FCFA</th>
														</tr>
													  </tfoot>';
												
												echo'</table>
														</center> ';
											}
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
