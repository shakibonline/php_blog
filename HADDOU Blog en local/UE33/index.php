<?php 
	include('includes/connexion.inc.php');
	include('includes/haut.inc.php'); 
	include('includes/fonctions.inc.php');


	//PAGINATION
	$app=3;//articles par pages
	$page=(int)var_get('p');//page courante
	if(!$page) $page=1; //si la variable page n'existe, on la place à 1
	$debut=($page-1)*$app;//index de départ
	$rech=mysql_real_escape_string(var_get('r'));//recherche

	$where=isset($rech)?"WHERE texte LIKE '%$rech%'":''; //condition si recherche
	$sql=("SELECT COUNT(*) AS total FROM article $where");
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result); //fournit un tableau, d'où le besoin du $data
	$total=$data['total'];//total d'articles
	$nbpages=ceil($total/$app); //permet d'arrondir au superieur le nombre de pages nécessaires

	$sql="SELECT * FROM article $where ORDER BY date DESC LIMIT $debut,$app";
	$result = mysql_query($sql);


	$h2=($rech)?'Résultats de la recherche "'.$rech.'"':'Derniers articles';
	echo ("<h2>".$h2."</h2>");
?>



<?php
	while($data = mysql_fetch_array($result)){ //boucle pour la liste d'articles ?>
	<article>
		<h3><?php echo $data['titre']; ?></h3>
			<p>
				<?php echo nl2br(htmlspecialchars($data['texte']));?>
				<br>
				<?php echo date('\L\e d/m/Y  \à H:i:s',$data['date']); // format de la date ?>
			</p>
	</article>
	<a href="article.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Modifier</a>
	<a href="supprimer_article.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Supprimer</a>

<?php
} 
	$rech=urlencode($rech);
	$rech=htmlspecialchars($rech);
	$pager=($rech)?'&r='.$rech.'':'';
?>
<div class="pagination pagination-centered">
	<ul>
		<li class="prev <?php if ($page<=1) { echo "disabled";}?>"><a href="?p=<?php if($page<=1){echo "#null";} else{ echo $page-1; echo $pager;} ?>">&larr; Précédent</a></li>
		<?php
		for($i=1; $i<=$nbpages;$i++){		
			echo("<li");
			if($page==$i) echo " class='active'";
			echo("><a href='?p=");
			echo ($i);
			echo $pager;
			echo("'>");
			echo ($i);
			echo("</a></li>");
		}
		?>
		<li class="next <?php if ($page>=$nbpages){ echo "disabled";}?>"><a href="?p=<?php if($page>=$nbpages){echo $page ;} else{ echo $page+1; echo $pager;} ?>">Suivant&rarr; </a></li>
    </ul>
</div>

<?php
	include('includes/bas.inc.php');