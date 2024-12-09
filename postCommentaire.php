<?php
  //-----------------------------------
  //   Fichier :  postCommentaire.php
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------


include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

    //id:number = 0;
$idDev = $_POST['idDev'];
$idSess = $_POST['idSession'];
$contenu = $_POST['contenu'];

try
{
   $maBD = new bdService();
   $dateComm = date('Y-m-d H:i:s');
   $ins = "insert into commentaires value(null, '$contenu', '$dateComm', $idSess, $idDev )";
   $idNeoComm = $maBD->insertion($ins);
   
   echo json_encode($idNeoComm);
}

catch(Exception $e)
{
	echo "Erreur 23: " . $e->getMessage();
}
