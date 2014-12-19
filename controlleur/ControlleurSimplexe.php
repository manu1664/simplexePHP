<?php
require_once 'vue/Vue.php';


class ControlleurSimplexe {
    


    public  function __construct() {
        
    }
    
    //afficher le formulaire du simplexe
    public function afficherFormFonctions() {
        $vueSimplexe = new Vue("Simplexe");
        $vueSimplexe->generer();
    }
    
    public function afficherFonctions(){
        $tabSimplexe = new Vue("Tableau");
        $tabSimplexe->generer();
    }
}

