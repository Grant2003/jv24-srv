<?php

  //-----------------------------------
  //   Fichier :  getStatsPourUnDev
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');



try
{	
	$maBD = new bdService;
	$selIdDev = "select * from developpeurs";
    $tabDev = $maBD->selection($selIdDev);
	$sel = "select id, debut, fin, idDev from sessionstravail";
	$tabSess = $maBD->selection($sel);

	for($i=0; $i < count($tabDev); $i++)
	{
		$nbSessions =0;
		$nbsecondes = 0;
		for($j=0; $j < count($tabSess); $j++)
		{
			if($tabSess[$j]['idDev'] == $tabDev[$i]['id'])
			{
				$nbSessions++;
				$nbsecondes += calculerduree($tabSess[$j]['debut'], $tabSess[$j]['fin']);
			}
		}
		$idDev=$tabDev[$i]['id'];
		$sel = "select count(*) as nbComm from commentaires where idDev = $idDev";	
	    $tabComm = $maBD->selection($sel);
	    $nbComm = $tabComm[0]['nbComm'];
		$tabDevTemp[0]=$tabDev[$i]['id'];
		$tabDevTemp[1]=(string)$nbsecondes;
		$tabDevTemp[2]=$nbComm;
		$tabDevTemp[3]=(string)$nbSessions;
		$tabinfodev[]=$tabDevTemp;
	}
	echo json_encode($tabinfodev);

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