<?php 
    
	include('includes/connexion.inc.php');
	include('includes/haut.inc.php'); 
	include('includes/fonctions.inc.php'); 
?>

	<form action="article.php" method="post" enctype="multiport/form-data">
<?php
	// modification
	$id =(int)var_get('id');
	$action_label=($id)?'Modifier':'Ajouter';
	$rech=mysql_real_escape_string(var_get('r'));
	echo ("<h2>".$action_label." un article</h2>");  
	If ($id){
			$resultat = mysql_query("SELECT * FROM article WHERE id='$id'"); 
			$data = mysql_fetch_array($resultat);
	}

 

 

	If (isset($_POST['post'])){
	//vérification des valeurs entrées
		$titre= var_post('titre');
		$texte= var_post('texte');
	
		If (!$titre || !$texte){ // les données sont pas remplies ?> 
		<div class='alert alert-error'>
			Veuillez saisir tous les champs.
		</div>	
		
	<?php
	if empty ( $_files['img']['tmp_name']===false){
  $file_ext = end[explode('.';$_files['img']['name']}};
if (in_array(strtolower($file_ext),array('jpg','jpeg','png'))===false){
$errors[]=une iupmage svp';
}
}	
		}
	Else {

		//pour l'ajout
		$titre = mysql_real_escape_string($titre);
		$texte = mysql_real_escape_string($texte);
		if ( file_exists($img)){
		    $src_size = getimagesize($img);
			if ($src_size['mine'] ==='image/jpeg'){
			   $src_img =imagecreatefromjpeg($img);
			   }
			   else if ($src_size['mine'] ==='image/png'){
			   $src_img =imagecreatefrompng($img);
		 }
			   else if ($src_size['mine'] ==='image/gif'){
			   $src_img =imagecreatefromgif$img);
			   }else{
			   $src_img = false;}
			   
			   if($src_img !== false){
			   $thumb_width=200;
			   if($src_size[0] <= $thumb_width){
			       $thumb =$src_img ;
			   
			   }else{
			   $new_size[0] = $thumb_width;
			   $new_size[1] = ($src_size[1] / $src_size[0]) * $thumb_width;
			   $thumb=imagecreatetruecolor($new_size[0], $new_size[1]);
			   imagecopyresampled($thumb,$src_img, 0 , 0 ,0 ,0, $new_size[0],$src_size[0],$src_size[1]);
			   
			   
			   }
			   imagejpeg($thumb,"{$globals['path']}/user_img/{$_session['uid]}.jpg");
			   }
			   }
			   
		
		
		$id=(int)var_post('id');
		If ($id)
			requete_notif("UPDATE article SET titre='$titre', texte='$texte' WHERE id='$id'",'article','modifié'); //fonction qui modifie et qui teste
		else
			requete_notif("INSERT INTO article (titre, texte) VALUES ('$titre','$textes')",'article','ajouté'); //fonction ajouter et tester
			
		//redirection
		header('Location:index.php'); 
		exit();
	}
}

		?>
	<div class="clearfix">
		<label for="titre">Titre</label>
		<div class="input"><input type="text" name="titre" id="titre" value="<?php If (isset($data['titre'])) echo $data['titre']; ?>"></div> 
	</div>
	<div class="clearfix">
		<label for="texte">Texte</label>
		<div class="input"><textarea name="texte" id="texte"><?php If (isset($data['texte'])) echo $data['texte']; ?></textarea></div> 
	</div>
	<div class="clearfix">
	<input type="file" name="image" id= "image"> 
		</div>
		
	<div class="clearfix">
		<div class="input"><input type="checkbox" name="publie" id="publie" value="Uploader"><label for="publie">Publier</label></div> 
	</div>
	<div class="form-actions">
		<input type="submit" value="<?php echo $action_label; ?>" class="btn btn-large btn-primary"> 
		<input type="hidden" name='post' value=""> 
		<input type="hidden" name='id' value="<?php echo $id; ?>">		
	</div>
	<div class="clearfix">
		<label for="tag">Tag*</label>
		<div class="input"><input type="text" name="tag" id="tag" value="{if isset($data['tag'])} {$data['tag']}{/if}"></div>
	</div>
	
</form>
<?php
require_once('includes/bas.inc.php');