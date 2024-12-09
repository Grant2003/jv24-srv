<?php
  //-----------------------------------
  //   Fichier :  getConnexion.php
  //   Par:      Alain Martel
  //   Date :    2024-10-21
  //   Modifié par :  
  //-----------------------------------

include('bdService.php');
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');

$mat = $_POST['mat'];
$mdp = $_POST['mdp'];

try
{
   $maBD = new bdService();
   $sel = "select * from developpeurs where matricule = '$mat'";
   $tabDev = $maBD->selection($sel);
   
   if (isset($tabDev[0]['motDePasse'] ) )
   { 	 
      if ($tabDev[0]['motDePasse'] == $mdp)
	  {
         $statut = 'inactif';

         $sel = "select * from sessionstravail where idDev= " . $tabDev[0]['id'] . " and fin is null";
		 $tabSessTravActive = $maBD->selection($sel);
		 
		 // Algo déterminant si le dev est actif ou non
		 if (isset($tabSessTravActive[0]))
		 {
			 if(empty($tabSessTrav[0]['fin'])) 
			 {
				 $statut = 'actif';
			 }
		 }
	 
		 $tabDev[0]['etat'] = $statut;
         echo json_encode($tabDev[0]);
	  }
	  else
		 echo ""; 
   }
   else
   {
	   echo "";
   }
}

catch(Exception $e)
{
	echo "Erreur 9: " . $e->getMessage();
}
