<?php
$mois = getMois(date('d/m/Y')); //retourne aaaa.mm qd on rentre la date, en supprimant la valeur du jour
$moisPrecedent= getMoisPrecedent($mois);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$fichesCL = $pdo->ficheDuMoisCloturees($moisPrecedent);
$pdo = PdoGsb::getPdoGsb();

switch ($action) {
    case 'valider':
        $lesVisiteurs = $pdo->getLesVisiteurs($pdo);
        $lesMois = getLesDouzeDerniersMois($mois);
        $lesClesM = array_keys($lesMois);
        $moisASelectionner = $lesClesM[0];
        $lesClesV = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesClesV[24];
        if ($fichesCL){
            include 'vues/v_listesVisiteursMois.php';
        }else{
           $pdo->clotureFicheFrais($moisPrecedent); //cr en cl
           include 'vues/v_listesVisiteursMois.php';
       }
    break;
    case 'valideVM':
       $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
       $leVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
       $moisASelectionner = $leMois;   
       $visiteurASelectionner = $leVisiteur; 
       $lesMois = getLesDouzeDerniersMois($mois);
       $lesVisiteurs = $pdo->getLesVisiteurs($pdo);
       include 'vues/v_listesVisiteursMois.php';
       $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
       $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
       $infosFiche = $pdo ->getLesInfosFicheFrais($leVisiteur, $leMois);

       if (!is_array($infosFiche)){
           ajouterErreur("Pas de fiche frais pour ce visiteur ce mois");
           include 'vues/v_erreurs.php';
       }else{
           include 'vues/v_afficheFrais.php';
       }
       break;
    default;
}


