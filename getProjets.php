<?php

  //-----------------------------------
  //   Fichier :  getProjets.php
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

try
{
   $maBD = new bdService();
   $sel = "select * from projets";
   $tabProj = $maBD->selection($sel);
   
   echo json_encode($tabProj);
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}
