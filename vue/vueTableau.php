<?php
require_once 'modele/Simplexe.class.php';
$simplex = new Simplexe($_POST['NbContrainte'], $_POST['NbVariable']);
$simplex->remplirMatrice();
$simplex->creationMatriceNomVariable();
$noms = $simplex->getMatriceNomVariable();

while($simplex->chercheMax($simplex->getMatrice()) > 0 ){
    $simplex->resolutionProbleme();    
    require 'Tableau.php';
} 
    echo $simplex->toStringFin();
    //require 'Tableau.php';




