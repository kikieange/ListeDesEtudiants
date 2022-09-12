<?php 
include_once 'connexion.php';
$id=isset($_GET['id_modif'])? $_GET['id_modif']:0;
$req1=$conn->prepare("SELECT * FROM etudiants WHERE idEtudiants=:id");
$req1->bindParam(':id',$id);
$req1->execute();
$resultat1=$req1->fetch(PDO::FETCH_ASSOC);
//recuperation et test des données
if(isset($_POST['modifier'])){
	$nom=trim(htmlspecialchars($_POST['nom']));
	$prenom=trim(htmlspecialchars($_POST['prenom']));
	$adressegeo=trim(htmlspecialchars($_POST['adressegeo']));
	$ville=trim(htmlspecialchars($_POST['ville']));
	$codepostal=trim(htmlspecialchars($_POST['codepostal'])); 
	$pays=trim(htmlspecialchars($_POST['pays']));
	$mail=htmlspecialchars($_POST['mail']);

	if (empty($nom)) {
		$erreur="veuillez saisir votre nom svp!";
	}elseif (empty($prenom)) {
		$erreur="veuillez saisir votre prenom";
	}elseif (empty($adressegeo)) {
		$erreur="veuillez saisir votre adresse geographique";
    }elseif (empty($ville)) {
		$erreur="veuillez entrez votre ville svp!";
	}elseif (empty($codepostal) or !is_numeric($codepostal)) {
		$erreur="veuillez saisir votre code Postal valide !";
	}elseif (empty($pays)) {
		$erreur="veuillez saisir votre pays svp!";
	}elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
		$erreur="veuillez saisir un mail correct!";
	}else{
		$req2=$conn->prepare("UPDATE etudiants SET Nom=:nom,Prenom=:prenom,Adresse=:adresse,Ville=:ville,Codepostal=:codepostal,Pays=:pays,Mail=:mail WHERE idEtudiants=:id");
		$req2->bindParam(':nom',$nom);
		$req2->bindParam(':prenom',$prenom);
		$req2->bindParam(':adresse',$adressegeo);
		$req2->bindParam(':ville',$ville);
		$req2->bindParam(':codepostal',$codepostal);
		$req2->bindParam(':pays',$pays);
		$req2->bindParam(':mail',$mail);
		$req2->bindParam(':id',$id);
		$req2->execute();
		$succes=true;
		header("Refresh:1");
	}
}
include_once 'header.php';
 ?>
<div class="container">	
	<form action="" method="POST">
		<table class="table table-bordered">
			<?php 
			if (isset($erreur)) {
				echo "<div class='alert alert-warning'>";
				echo "<strong>Désolé</strong>".$erreur;
				echo "</div>";
			}
			if(isset($succes)){
			 			echo "<div class='alert alert-info'>";
			 			echo "<strong>Félicitation!</strong> Etudiant modifier avec succès!";
			 			echo "</div>";
			 				}

			 ?>	 
		
			<tr>
				<td>Nom</td>
				<td><input type="text" name="nom"  class="form-control" value="<?php echo isset($resultat1['Nom']) ?$resultat1['Nom']:'';?>"></td>
			</tr>
			<tr>
				<td>Prenom</td>
				<td><input type="text" name="prenom"  class="form-control" value="<?php echo isset($resultat1['Prenom']) ?$resultat1['Prenom']:'';?>"></td>
			</tr>
			<tr>
				<td>Adresse géographique</td>
				<td><input type="text" name="adressegeo"  class="form-control" value="<?php echo isset($resultat1['Adresse']) ?$resultat1['Adresse']:'';?>"></td>
			</tr>
			<tr>
				<td>Ville</td>
				<td><input type="text" name="ville"  class="form-control" value="<?php echo isset($resultat1['Ville']) ?$resultat1['Ville']:'';?> "></td>
			</tr>
			<tr>
				<td>Code Postal</td>
				<td><input type="text" name="codepostal"  class="form-control" value="<?php echo isset($resultat1['Codepostal']) ?$resultat1['Codepostal']:'';?>"></td>
			</tr>
			<tr>
				<td>Pays</td>
				<td><input type="text" name="pays"  class="form-control" value="<?php echo isset($resultat1['Pays']) ?$resultat1['Pays']:'';?>"></td>
			</tr>
			<tr>
				<td>Mail</td>
				<td><input type="text" name="mail"  class="form-control" value="<?php echo isset($resultat1['Mail']) ?$resultat1['Mail']:'';?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="btn btn-primary" name="modifier">
						<span class="glyphicon glyphicon-plus"></span>&nbsp;modifier Etudiant
					</button>
					
					<a href="index" class="btn btn-large btn-success">
						<i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Retour vers liste étudiant
					</a>
				</td>	
			</tr>
		</table>

	</form>
</div>
<?php include_once 'footer.php' ?>