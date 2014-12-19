<?php
    //index.php le simplexe
    require 'controlleur/Routeur.php';
    $routeur = new Routeur();
    $routeur->routerRequete();

