<?php
require_once 'elementMatrice.class.php';
/**
 * Description of Matrice
 *
 * @author emmanuellemettre
 */
class Matrice {
    //variables d'instance
    private $matrice;
    private $nbLignes = 0;
    private $nbColonnes = 0;
    
    public function __construct($nbLignes, $nbColonnes) {
        $this->nbLignes = $nbLignes;
        $this->nbColonnes = $nbColonnes;
        $this->matrice = array(array());
    }
    
    //GETTER
    public function getMatrice(){
        return $this->matrice;
    }
    
    public function getValeurMatrice($col, $lig){
        return $this->getMatrice()[$col][$lig];
    }
    
    public function getNbLignes(){
        return $this->nbLignes;
    }
    
    public function getNbColonnes(){
        return $this->nbColonnes;
    }
    
    //SETTER
    public function setMatrice($matrice){
        $this->matrice = $matrice;
    }
    
    public function setNbLignes($nbLignes){
        $this->nbLignes = $nbLignes;
    }
    
    public function setNbColonnes($nbColonnes){
        $this->nbColonnes = $nbColonnes;
    }
    
    public function setValeurMatrice($col, $lig, $valeur){
        $this->matrice[$col][$lig] = $valeur;
    }
    
}
