<?php

class Vue {
    //nom du fichier associé à la vue
    private $fichier;
    //titre de la vue (défini dans le fichier vue)
    private $titre;
    
    public function __construct($action) {
        $this->fichier = "vue/vue".$action.".php";
    }
    
    //génère et affiche la vue
    public function generer() {
      // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('vue/gabarit.php',
                array('titre' => $this->titre, 'contenu' => $contenu));
        // Renvoi de la vue au navigateur
        echo $vue;  
    }
    
    public function genererAvecDonnees($donnees) {
      // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('vue/gabarit.php',
                array('titre' => $this->titre, 'contenu' => $contenu));
        // Renvoi de la vue au navigateur
        echo $vue;  
    }
    
    //génére un fichier vue et revoie le résultat produit
    private function genererFichier($fichier, $donnees) {
        if(file_exists($fichier)) {
            extract($donnees);
            //démarrage de la temporisation de sortie
            ob_start();
            //Inclut le fichier vue
            //son résultat est placé dans le tampon de sortie
            require $fichier;
            //Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }
    
}

