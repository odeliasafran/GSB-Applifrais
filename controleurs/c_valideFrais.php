 <?php
$mois =getMois(date('d/m/y'));
$moisPrecedent = getMoisPrecedent($mois);
$action= filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
$pdo = PdoGsb::getPdoGsb();
     
switch ($action){
    case 'valider':
        $lesVisiteurs = $pdo->getLesVisiteurs($pdo);
        $lesClesV = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesClesV[24];
        $lesMois =lesDouzeMoisPrecedents($mois);
        $lesClesM =array_keys($lesMois);
        $moisASelectionner = $lesClesM[0];
        include 'vues/v_listesVisiteursMois.php';
      break;
    default;
}
