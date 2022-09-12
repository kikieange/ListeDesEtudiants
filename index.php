<?php
	require_once 'connexion.php'; 
	$size=isset($_GET['size'])?$_GET['size']:2;
	$page=isset($_GET['page'])?$_GET['page']:1;
	$offset=($page-1)*$size;
	$req=$conn->query("SELECT * FROM etudiants ORDER BY DateInscription DESC Limit $size offset $offset");
	$reqCount=$conn->query("SELECT COUNT(*) countEt FROM etudiants");
	$tabCount=$reqCount->fetch();
	$nbrEtudiant=$tabCount['countEt'];
	$restmod=$nbrEtudiant%$size;
	if ($restmod===0) {
		$nbrepage=$nbrEtudiant/$size;
	}else{
		$nbrpage=floor($nbrEtudiant/$size)+1;
	}
//	$req=$conn->query("SELECT * FROM etudiants");

include_once 'header.php';?>
<div class="container">
	<a href="ajouter.php" class="btn btn-large btn-info">
		<i class="glyphicon glyphicon-plus">&nbsp;</i>
		Ajouter un étudiant
	</a>
	<br><br>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Adresse</th>
				<th>Ville</th>
				<th>Code</th>
				<th>Pays</th>
				<th>E-Mail</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($req->rowCount()>0){
				while ($ligne=$req->fetch()) {
				
					?>
					<tr>
				<td><?php echo $ligne['idetudiants'] ?></td>
				<td><?php echo $ligne['Nom'] ?></td>
				<td><?php echo $ligne['Prenom'] ?></td>
				<td><?php echo $ligne['Adresse'] ?></td>
				<td><?php echo $ligne['Ville'] ?></td>
				<td><?php echo $ligne['Codepostal'] ?></td>
				<td><?php echo $ligne['Pays'] ?></td>
				<td><?php echo $ligne['Mail'] ?></td>
				<td><?php echo $ligne['DateInscription'] ?></td>
				<td>
					<a href="modifier.php?id_modif=<?php echo $ligne['idetudiants'] ?>"><span class="glyphicon glyphicon-edit "></span></a>&nbsp;
					<a href="supprimer.php?id_supp=<?php echo $ligne['idetudiants'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $ligne['Nom']?>&nbsp;&nbsp;<?php echo $ligne['Prenom'] ?>?')"><span class="glyphicon glyphicon-trash "></span></a>
				</td>
			</tr>
			<?php  
				}
			}else{
					?>
					<tr>
						<td>
							<p>Aucun étudiant enregistrer pour l'instant</p>
						</td>
					</tr>
					<?php
			}
				
			?>
		</tbody>
	</table>
	<div>
		<ul class="pagination pagination-sm">
			<?php for ($i=1;$i <=$nbrepage ; $i++){?>
			<li class="<?php if($i==$page) echo 'active' ;?>">
				<a href="index.php?page=<?php echo $i;?>"><?php echo $i; ?></a>
			</li>
			<?php 
		}
			 ?>
		</ul>
	</div>
</div>