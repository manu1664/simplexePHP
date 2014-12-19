<?php

/**
 * Description of elementMatrice
 *
 * @author emmanuellemettre
 */
class elementMatrice {
    //variables d'instance
    private $ligne;
    private $colonne;
    private $valeur;
    
    //constructor
    public function __construct() {
        
    }
    
    //GETTER
    public function getLigne() {
        return $this->ligne;
    }

    public function getColonne() {
        return $this->colonne;
    }

    public function getValeur() {
        return $this->valeur;
    }

    //SETTER
    public function setLigne($ligne) {
        $this->ligne = $ligne;
    }

    public function setColonne($colonne) {
        $this->colonne = $colonne;
    }

    public function setValeur($valeur) {
        $this->valeur = $valeur;
    }


}
