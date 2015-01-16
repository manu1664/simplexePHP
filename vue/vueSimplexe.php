<?php $this->titre = "Le simplexe en PHP"; ?>

<?php
require 'modele/Formulaire.class.php';


$form = new Formulaire($_GET['nbreVariable'], $_GET['nbreContrainte']);
$form->fonctionEconomique();
$variable = $form->getFonctionEconomique();

$form->inequation();
$contrainte = $form->getInequation();

 require 'vueSimplexeForm.php';
 
 