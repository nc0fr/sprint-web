<?php
require_once('Controleur/controleur.php');

try {
    if (isset($_POST['connexion'])){
        $usr=$_POST['login'];
        $mdp=$_POST['mdp'];
        ctrlVerifierId($usr,$mdp);
        
    }elseif (isset($_POST['gestionJustificative'])){

        ctrlGestionJustificative();

    }else{
        ctrlPageLogin();
    }
}


catch(Exception $e) {
    $msg = $e->getMessage() ; 
    ctrlErreur($msg); 
    }