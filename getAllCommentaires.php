<?php
  //-----------------------------------
  //   Fichier :  getAllCommentaires.php
  //   Par:      AnthonyGrenier
  //   Date :    2024-10-21
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

try
{
   $maBD = new bdService();
   $sel = "select * from commentaires";
   $tabCommentaires = $maBD->selection($sel);
   
   echo json_encode($tabCommentaires);
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}