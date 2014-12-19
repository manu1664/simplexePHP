<?php 
require_once 'controlleur/ControlleurAccueil.php';
require_once 'controlleur/ControlleurSimplexe.php';
require_once 'vue/Vue.php';

class Routeur {
    private $ctrlAccueil;
    private $ctrlSimplexe;
        
    public function __construct() {
        $this->ctrlAccueil = new ControlleurAccueil();
        $this->ctrlSimplexe = new ControlleurSimplexe();
    }
    
    //Traite une requete entrante
    public function routerRequete(){
        try {
            if (isset($_GET['nbreVariable']) && (isset($_GET['nbreContrainte']))){
                $valParametreVariable = intval($this->getParamatre($_GET,'nbreVariable'));
                $valParametreContrainte = intval($this->getParamatre($_GET,'nbreContrainte'));
                if(($valParametreContrainte!=0)&&($valParametreVariable!=0)){
                   $this->ctrlSimplexe->afficherFormFonctions();
                }
                else{
                    throw new Exception("valeur de paramètre non valide");
                }
            }elseif (isset($_POST['X1'])) {
                $this->ctrlSimplexe->afficherFonctions();                
            }
            else { //aucune variable et contrainte définie :  affichage de l'accueil
                $this->ctrlAccueil->accueil();
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    } 
        
        //affiche une erreur
        private function erreur($msgErreur) {
            $vue = new Vue("Erreur");
            $vue->generer(array('msgErreur' => $msgErreur));
        }
        
        //Recherche un parametre dans un tableau
        private function getParamatre($tableau, $nom){
            if(isset($tableau[$nom])){
                return $tableau[$nom];
            }
            else {
            throw new Exception("Paramètre '$nom' absent");
            }
        }
}
