<?php

  //-----------------------------------
  //   Fichier :  getDevs.php
  //   Par:      Anthony Grenier
  //   Date :    2024-11-21
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

try
{
   $maBD = new bdService();
   $sel = "select * from developpeurs";
   $tabDevs = $maBD->selection($sel);
   
   echo json_encode($tabDevs);
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}