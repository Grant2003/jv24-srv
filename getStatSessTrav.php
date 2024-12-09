<?php


  //-----------------------------------
  //   Fichier :  getStatSessTrav.php
  //   Par:      Anthony Grenier
  //   Date :    2024-10-21
  //-----------------------------------
include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');



try
{	
	$maBD = new bdService;

	$sel = "select id, debut, fin, idDev from sessionstravail";
	$tabSess = $maBD->selection($sel);

	
		$nbsecondes = 0;
		for($i=0; $i < count($tabSess); $i++)
		{
			$nbsecondes = 0;
			$idSess=$tabSess[$i]['id'];
		    $nbsecondes += calculerduree($tabSess[$i]['debut'], $tabSess[$i]['fin']);
			$sel = "select count(*) as nbComm from commentaires where idSession = $idSess";	
	        $tabComm = $maBD->selection($sel);
	        $nbComm = $tabComm[0]['nbComm'];
			$pairIdDuree[0]=$idSess;
			$pairIdDuree[1]=(string)$nbsecondes;
			$pairIdDuree[2]=(string)$nbComm;
			$tabStats[] = $pairIdDuree;
			
		}
	echo json_encode($tabStats);
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}

function calculerDuree($debut,$fin)
{
	$dateDebut = DateTime::createFromFormat("Y-m-d H:i:s",$debut);	

	
	if(isset($fin))
		$dateFin = DateTime::createFromFormat("Y-m-d H:i:s",$fin);
	
	else
		$dateFin = new DateTime();
	
	$debutEpoch = $dateDebut->getTimeStamp();
	$finEpoch = $dateFin->getTimeStamp();
	return$finEpoch - $debutEpoch;
}