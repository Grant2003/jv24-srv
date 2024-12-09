<?php

  //-----------------------------------
  //   Fichier :  postSessionTravail.php
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------
include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

    //id:number = 0;
$idDev = $_POST['idDev'];
$idTache = $_POST['idTache'];

try
{
   $maBD = new bdService();
   $debut = date('Y-m-d H:i:s');
   $ins = "insert into sessionstravail value(null, $idTache, '$debut',  null, $idDev )";
   $idNeoSessTrav = $maBD->insertion($ins);
   
   echo json_encode($idNeoSessTrav);
}

catch(Exception $e)
{
	echo "Erreur 22: " . $e->getMessage();
}
