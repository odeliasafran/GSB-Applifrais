<?php

$estConnecteVisiteur = estConnecteVisiteur();
$estConnecteComptable = estConnecteComptable();

if ($estConnecteVisiteur) {
include
    'vues/v_accueilVisiteur.php';
}
  elseif 
    ($estConnecteComptable){
     include 'vues/v_accueilComptable.php';
} else {
    include 'vues/v_connexion.php';
}
