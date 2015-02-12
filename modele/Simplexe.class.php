<?php
require_once 'Matrice.class.php';

class Simplexe {
    //variables d'instance
    private $nbContraintes;
    private $nbVariables;
    private $nbVariablesEcart;
    private $matriceDepart;
    private $matrice;
    private $matriceNomVariable;
    private $matriceNomVariableBase;
    private $jMaxDerniereLigne; //Numero de colone de la valeur max        
    private $pivot;
    private $numMethode;
    private $nbIteration=0;
    
    //constructor
    public function __construct($nbContraintes, $nbVariables) {
        $this->nbContraintes = $nbContraintes;
        $this->nbVariables = $nbVariables;
        $this->nbVariablesEcart = $nbContraintes;
        $this->matriceDepart = new Matrice($nbContraintes+1, $nbVariables+$this->nbVariablesEcart+1);
        $this->matrice = new Matrice($nbContraintes+1, $nbVariables+$this->nbVariablesEcart+1);
    }
    
    //Fonction pour resoudre le probleme
    public function resolutionProbleme(){
       // $max = $this->chercheMax($this->matrice);

       // if($max>0){
            //$this->afficheMatrice($this->matriceDepart);
            $this->cherchePivot($this->matrice);
            $this->soustractionLigne($this->matrice);
            $this->divisionLignePivot($this->matrice);
            $this->changementVariableBase();
            $this->nbIteration++;
        // }
         //echo 'Fin du probleme<br>';
         //var_dump($this->matrice);
         //echo '<br><hr>';
    }
    
    //Remplissage de la matrice avec les valeurs des coefficients + matrice identite + matrice result + matrice fonction eco
    public function remplirMatrice() {
        $matriceDepartTemp;
        $i=0;
        while ($i < $_POST['NbVariable']){
            for($j=0; $j < $this->nbContraintes; $j++){
                for($k=0; $k < $this->nbVariables; $k++){
                    $matriceDepartTemp[$j][$k] = (real)$_POST['C'.($j+1).'X'.($k+1)];
                    $i++;
                 
                }
            }
        }
       
        //On ajoute la matrice identite a la matrice des coefficients
        $matriceIdentite = $this->creationMatriceIdentite();
        for($i=0; $i < count($matriceIdentite); $i++){
            for($j=0; $j < count($matriceIdentite); $j++){
                $matriceDepartTemp[$i][$this->nbVariables+$j] = $matriceIdentite[$i][$j];
                
            }                      
        }

        //Ajout de la matrice maximisant
        $matriceResult = $this->creationMatriceMaximisant();
        $colonne = count($matriceDepartTemp[0]);
        for($i=0; $i < count($matriceResult); $i++){
            $matriceDepartTemp[$i][$colonne] = $matriceResult[$i];
        }
        
        //Ajout de la matrice de la fonction économique
        $matriceFonctionEco = $this->creationMatriceFonctionEco();
        $ligne = count($matriceDepartTemp);
        for($i=0; $i < count($matriceFonctionEco); $i++){
            $matriceDepartTemp[$ligne][$i] = $matriceFonctionEco[$i];
        }
        
        //var_dump($matriceDepartTemp);
        $this->matrice->setMatrice($matriceDepartTemp);        
        $this->matriceDepart->setMatrice($matriceDepartTemp);
    }
    
    //Creation de la matrice identite
    public function creationMatriceIdentite(){
        for ( $i=0; $i < $this->nbVariablesEcart ; $i++){
            for ($j=0; $j < $this->nbVariablesEcart; $j++){
                if ($i==$j)          
                    $matriceIdentite[$i][$j]=(real)1;
                else
                    $matriceIdentite[$i][$j]=(real)0;
            }
        }
        return $matriceIdentite; 
    }
    
    //Creation de la matrice de la fonction économique
    public function creationMatriceFonctionEco(){
        for($i=0; $i < ($this->nbVariables); $i++){
            $matriceFonctionEco[$i] = (real)$_POST['X'.($i+1)];
        }
                
        for($j=$this->nbVariables; $j < ($this->nbVariables+$this->nbContraintes+1); $j++){
            $matriceFonctionEco[$j] = (real)0;
        }
        return $matriceFonctionEco;
    }
    
    //création de la matrice result
    public function creationMatriceMaximisant(){
        for($i=0;$i < $this->nbContraintes; $i++){
            $matriceResult[$i] = (real)$_POST['C'.($i+1)];                                  
        }
        return $matriceResult;
    }
    
    //Creation nom variable valeur d'ecart
    public function creationMatriceNomVariableEcart(){
        for ($i=0; $i < $this->nbVariablesEcart; $i++){
           $nomVariableEcart = "U" . ($i+1);
           $matriceNomVariableEcart[$i] = $nomVariableEcart;
        }

        return $matriceNomVariableEcart;
    }
       
    //Creation de la matrice avec les noms de variables
    public function creationMatriceNomVariable(){
        $matriceNomVariableEcart = $this->creationMatriceNomVariableEcart();

        //Ajout des noms des variables
        for($i=0; $i < $this->nbVariables; $i++){
            $this->matriceNomVariable[$i] = "A" . ($i+1);
        }              

        //Ajout des noms des variables d'ecart
        $i=0;
        for($j = $this->nbVariables; $j < ($this->matriceDepart->getNbColonnes()-1); $j++){
            $this->matriceNomVariable[$j] = $matriceNomVariableEcart[$i];
            $i++;
        }
    }
       
    //Creation de la matrice avec les noms de variable appartenant a la base
    public function creationMatriceNomVariableBase(){
        $this->matriceNomVariableBase = $this->creationMatriceNomVariableEcart();
    }
    
    //Fonction pour afficher la matrice
    public function afficheMatrice($maMatrice){              
        for ($i=0; $i < count($maMatrice->getMatrice()) ; $i++){
            for ($j=0; $j < count($maMatrice->getMatrice()[0])  ; $j++){
                print($maMatrice->getMatrice()[$i][$j] . " | ");
            }
                echo '<br>';
        }
    }
    
    //Cherche le maximum sur la derniere ligne
    public function chercheMax($maMatrice){
        $maximum = 0;              
        $tailleMatrice = count($maMatrice->getMatrice());

        for($j=0; $j < count($maMatrice->getMatrice()[0]); $j++){
            if ($maMatrice->getMatrice()[$tailleMatrice-1][$j] > $maximum){
                $maximum = $maMatrice->getMatrice()[$tailleMatrice-1][$j];
                $this->jMaxDerniereLigne=$j;
            }
        }
        return $maximum;
    }
    
    //Cherche le pivot
    public function cherchePivot($maMatrice){
        $calculPivot = 9999;
        
        for ($i=0; $i < (count($maMatrice->getMatrice())-1); $i++){
            $calcul = ($maMatrice->getMatrice()[$i][(count($maMatrice->getMatrice()[0])-1)])/($maMatrice->getMatrice()[$i][$this->jMaxDerniereLigne]);
            if($calcul < $calculPivot && $calcul > 0) {
                $calculPivot = $calcul;
                $pivotTemp = new elementMatrice();
                $pivotTemp->setColonne($this->jMaxDerniereLigne);
                $pivotTemp->setLigne($i);
                $pivotTemp->setValeur($maMatrice->getMatrice()[$i][$this->jMaxDerniereLigne]);
            }
        }
        $this->pivot = $pivotTemp;
    }
    
     //Fonction qui divise la ligne du pivot par la valeur du pivot
    public function divisionLignePivot($maMatrice){
        for($j=0; $j < count($maMatrice->getMatrice()[0]); $j++){
            $maMatrice->setValeurMatrice($this->pivot->getLigne(), $j, ($maMatrice->getMatrice()[$this->pivot->getLigne()][$j] / $this->pivot->getValeur()));
        }
    }
    
    //Fonction qui soustrait chaque ligne a la ligne du pivot multiplié par un coefficient
    public function soustractionLigne($maMatrice){
        for ($i=0; $i < count($maMatrice->getMatrice()); $i++){
            if($i != $this->pivot->getLigne()){
                $coeffSoustraction = ($maMatrice->getMatrice()[$i][$this->pivot->getColonne()]) / $this->pivot->getValeur();
                for ($j=0; $j < count($maMatrice->getMatrice()[0]); $j++){
                    $maMatrice->setValeurMatrice($i,$j, ($maMatrice->getMatrice()[$i][$j])-($coeffSoustraction * $maMatrice->getMatrice()[$this->pivot->getLigne()][$j]));
                }
            }
        }
    }
    
    //Fonction qui fait entrer un nom de variable dans la base
    public function changementVariableBase(){
        $this->matriceNomVariableBase[$this->pivot->getLigne()] = $this->matriceNomVariable[$this->pivot->getColonne()];
    }
    
    //Fonction pour afficher infos sur le pivot
    public function pivot(){
        $this->cherchePivot($this->matrice);

        $textePivot = '<strong>Pivot : </strong><br> '
                . 'Valeur : ' . $this->pivot->getValeur() . '<br>'
                . 'Ligne : ' . ($this->pivot->getLigne()+1) . '<br>'
                . 'Colonne : ' . ($this->pivot->getColonne()+1);

        return $textePivot;
    }
    
    //Fonction pour afficher les infos sur la variable qui entre dans la base
    public function variableBase () {
        $texteVariableBase = "<strong>La variable qui rentre dans la base est : </strong>" . $this->matriceNomVariable[$this->pivot->getColonne()];

        return $texteVariableBase;
    }
    
    //Fonction qui affiche les infos sur le max
    public function valeurMaxi($maMatrice){
        $valeurMax = -($maMatrice->getMatrice()[count($maMatrice->getMatrice())-1][count($maMatrice->getMatrice()[0])-1]);
        $texteValeurMax = "<strong>Le maximum est : </strong>" . $valeurMax;
        return $texteValeurMax;
    }
        
    //Affiche caractéristique matrice
    public function toString() {
        $resultat = $this->pivot() . "<br>" . $this->variableBase() . "<br>" . $this->valeurMaxi($this->matrice);
        return $resultat;
    }
    
    //Affiche caractéristique matrice fin
    public function toStringFin(){
        $resultat = '<div class="alert alert-success" role="alert">Il n\'y a plus d\'itération possible. Le programme est fini'
                . '<br/>' . ' Nombre d\'itérations effectuées : ' . $this->getNbIteration()
                . '<br/>' . $this->valeurMaxi($this->matrice) . '</div>';

        return $resultat;
    }
    
    // Getters
    public function getMatriceNomVariable(){
        return $this->matriceNomVariable;
    }

    public function getMatriceNomVariableBase(){
        return $this->matriceNomVariableBase;
    }

    public function getNumMethode(){
        return $this->numMethode;
    }

    public function getNbIteration(){
        return $this->nbIteration;
    }
    
    public function getMatrice(){
        return $this->matrice;
    }
    
    public function getValeurMatrice($maMatrice,$col,$lig){
        return $maMatrice->getMatrice()[$col][$lig];
    }

    public function getMatriceDepart(){
        return $this->matriceDepart;
    }
   
    //Setter
    public function setNumMethode($numMethode){
        $this->numMethode = $numMethode;
    }
}