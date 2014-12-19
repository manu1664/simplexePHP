<?php
/**
 * Description of Formulaire
 *
 * @author emmanuellemettre
 */
class Formulaire {
    //variables d'instance
    private $nbVariable;
    private $nbContrainte;
    private $fonctionEconomique;
    private $inequation;
    
    //constructor
    public function __construct($nbVariable, $nbContrainte) {
        $this->nbVariable = $nbVariable;
        $this->nbContrainte = $nbContrainte;
        $this->fonctionEconomique = NULL;
    }
    
    //méthodes d'instance
    public function fonctionEconomique(){
        for($i=0; $i < $this->nbVariable; $i++){
            $this->fonctionEconomique[$i] =  ($i+1);
        }
    }
    
    public function inequation(){
        for($i = 0; $i < $this->nbContrainte; $i++){
            $this->inequation[$i] = ($i+1);
        }
    }




    //GETTER & SETTER
    public function getNbVariable() {
        return $this->nbVariable;
    }

    public function getNbContrainte() {
        return $this->nbContrainte;
    }

    public function setNbVariable($nbVariable) {
        $this->nbVariable = $nbVariable;
    }

    public function setNbContrainte($nbContrainte) {
        $this->nbContrainte = $nbContrainte;
    }
    
    public function getFonctionEconomique() {
        return $this->fonctionEconomique;
    }

    public function getInequation() {
        return $this->inequation;
    }




}
