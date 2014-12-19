<?php

require_once 'vue/Vue.php';

class ControlleurAccueil {
    
    
    public  function __construct() {
        
    }
    
    //afficher le formulaire du simplexe
    public function accueil() {
        $vueAccueil = new Vue("Accueil");
        $vueAccueil->generer();
    }   
}

