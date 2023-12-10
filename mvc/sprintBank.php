<?php
require_once('Controleur/controleur.php');

try {
    if (isset($_POST['connexion'])){
        $usr=$_POST['login'];
        $mdp=$_POST['mdp'];
        ctrlVerifierId($usr,$mdp);
        
    }elseif (isset($_POST['gestionMotif'])){

        ctrlGestionMotif();

    }elseif (isset($_POST['showAllPieces'])){

        ctrlGetAllPieces();

    }else{
        ctrlPageLogin();
    }
}


catch(Exception $e) {
    $msg = $e->getMessage() ; 
    ctrlErreur($msg); 
    }