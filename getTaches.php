<?php

  //-----------------------------------
  //   Fichier :  getTaches.php
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

$idProj = $_GET['idProj'];

try
{
   $maBD = new bdService();
   $sel = "select * from taches where idProjet = $idProj";
   $tabTac = $maBD->selection($sel);
   
   echo json_encode($tabTac);
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}
