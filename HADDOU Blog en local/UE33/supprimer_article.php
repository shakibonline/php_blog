<?php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');
$id =(int)var_get('id');
if($id) requete_notif("DELETE FROM article WHERE id='$id'",'article','supprimé');//supprime l'article et confirme le succès par une notification
header('Location:index.php');