<?php
require_once 'modele/Simplexe.class.php';
$simplex = new Simplexe($_POST['NbContrainte'], $_POST['NbVariable']);
$simplex->remplirMatrice();
$simplex->creationMatriceNomVariable();
$simplex->creationMatriceNomVariableBase();
$noms = $simplex->getMatriceNomVariable();

////affiche itération 0
//$simplex->chercheMax($simplex->getMatrice());
//$simplex->cherchePivot($simplex->getMatrice());
//require 'Tableau.php';

//affiche la resolution par le simplexe par itération
while($simplex->chercheMax($simplex->getMatrice()) > 0 ){
    require 'Tableau.php';
    $simplex->resolutionProbleme();    
    
} 
    require 'Tableau.php';
    echo $simplex->toStringFin();
    //require 'Tableau.php';




