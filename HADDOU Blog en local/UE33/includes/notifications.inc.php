<?php
//notifications pour l'article appelées dans le haut.inc

$croix ='<a class="cacher-notif" href="#null">X</a>';

if(isset($_SESSION['article'])){
	switch ($_SESSION['article']){
		case 'ajouté':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été ajouté. </span>".$croix."</div>");
			break;
		case 'modifié':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été modifié. </span>".$croix."</div>");
			break;
		case 'supprimé':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été supprimé. </span>".$croix."</div>");
			break;
		case 'erreur':
			echo ("<div class='alert alert-error' id='notif'><span>Il y a une erreur. </span>".$croix."</div>");
			break;
	}
	unset($_SESSION['article']);
}
else if (isset($_SESSION['utilisateur'])){
	switch ($_SESSION['utilisateur']){
		case 'connecté':
			echo ("<div class='alert alert-success' id='notif'><span>Vous êtes bien connecté. </span>".$croix."</div>");
			break;
		case 'déconnecté':
			echo ("<div class='alert alert-success' id='notif'><span>Vous êtes bien déconnecté. </span>".$croix."</div>");
			break;
		case 'invalide':
			echo ("<div class='alert alert-error' id='notif'><span>Vos identifiants sont invalides. </span>".$croix."</div>");
			break;
		case 'erreur':
			echo ("<div class='alert alert-error' id='notif'><span>Il y a une erreur. </span>".$croix."</div>");
			break;
			
	}
	
unset($_SESSION['utilisateur']);
}
else{
	echo ("<div class='alert hide' id='notif'><span></span>".$croix."</div>");
}