<?php 
include_once 'connexion.php';

$id=isset($_GET['id_supp'])?$_GET['id_supp']:0;
$req=$conn->prepare("DELETE  FROM etudiants WHERE idEtudiants=:id");
$req->bindParam(':id',$id);
$req->execute();
$succes=true;

header('Refresh:1;URL=index.php');

include_once 'header.php';
 ?>
 <div class="container">
 	<?php 

if(isset($succes)){
   echo "<div class='alert alert-info'>";
   echo "<strong>Félicitation!</strong> Etudiant supprimer avec succès!";
   echo "</div>";
			 }
 	 ?>



 </div>