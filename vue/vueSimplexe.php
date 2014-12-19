<?php $this->titre = "Les fonctions du simplexe en toute modestie"; ?>

<?php
require 'modele/Formulaire.class.php';


$form = new Formulaire($_GET['nbreVariable'], $_GET['nbreContrainte']);
$form->fonctionEconomique();
$variable = $form->getFonctionEconomique();

$form->inequation();
$contrainte = $form->getInequation();

 require 'vueSimplexeForm.php';
 
 