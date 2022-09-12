<?php   include_once 'connexion.php';
$nom=$prenom=$adressegeo=$ville=$codepostal=$pays=$mail="";
if(isset($_POST['ajouter'])){
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
	}
	if (!isset($erreur)) {
	$req=$conn->prepare('INSERT INTO etudiants(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail) VALUES(:nom,:prenom,:adresse,:ville,:codepostal,:pays,:mail)');

		$req->bindParam(':nom',$nom);
		$req->bindParam(':prenom',$prenom);
		$req->bindParam(':adresse',$adressegeo);
		$req->bindParam(':ville',$ville);
		$req->bindParam(':codepostal',$codepostal);
		$req->bindParam(':pays',$pays);
		$req->bindParam(':mail',$mail);
		$req->execute();
		$succes=true;
	}
}
?>
<?php include_once 'header.php ';?>


<div class="container">
	<form action="" method="POST">
		<table class="table table-bordered">
			<?php 
			if (isset($erreur)) {
				echo "<div class='alert alert-warning'>";
				echo "<strong>Désolé!</strong>".$erreur;
				echo "</div>";
			}
			 ?>	
			 <?php 
			 		if(isset($succes)){
			 			echo "<div class='alert alert-info'>";
			 			echo "<strong>Félicitation!</strong> Etudiant ajouté avec succès! <a href='index.php'>LISTE DES ETUDIANTS </a>";
			 			echo "</div>";
			 				}

			  ?>
			<tr>
				<td>Nom</td>
				<td><input type="text" name="nom"  class="form-control" placeholder="votre nom" 
					value="<?php $nom ;?>"></td>
			</tr>
			<tr>
				<td>Prenom</td>
				<td><input type="text" name="prenom"  class="form-control"  placeholder="votre Prenom" 
					value="<?php echo $prenom;  ?>"></td>
			</tr>
			<tr>
				<td>Adresse géographique</td>
				<td><input type="text" name="adressegeo"  class="form-control"  placeholder="votre Adresse géographique" value="<?php echo $adressegeo; ?>"></td>
			</tr>
			<tr>
				<td>Ville</td>
				<td><input type="text" name="ville"  class="form-control" placeholder="votre Ville" value="<?php echo $ville; ?>"></td>
			</tr>
			<tr>
				<td>Code Postal</td>
				<td><input type="text" name="codepostal"  class="form-control" placeholder="votre Code Postal" value="<?php echo $codepostal; ?>"></td>
			</tr>
			<tr>
				<td>Pays</td>
				<td><input type="text" name="pays"  class="form-control" placeholder="votre Pays" value="<?php echo $pays;?>"></td>
			</tr>
			<tr>
				<td>Mail</td>
				<td><input type="text" name="mail"  class="form-control" value="<?php echo $prenom;?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="btn btn-primary" name="ajouter">
						<span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter Etudiant
					</button>
					
					<a href="index" class="btn btn-large btn-success">
						<i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Retour vers liste étudiants
					</a>
				</td>	
			</tr>
		</table>

	</form>
</div>
<?php include_once 'footer.php' ?>