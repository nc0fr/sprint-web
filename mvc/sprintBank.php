<?php
require_once('Controleur/controleur.php');

try {
    if (isset($_POST['connexion'])){
        $usr=$_POST['login'];
        $mdp=$_POST['mdp'];
        ctrlVerifierId($usr,$mdp);
        
    }elseif (isset($_POST['gestionMotif'])){

        ctrlGestionMotif();

    }elseif (isset($_POST['showAllMotif'])){

        ctrlGetAllMotif();

    }elseif (isset($_POST['modifierPiece'])){

        ctrlModifierPiece($_POST);

    }elseif (isset($_POST['gestionTypeCompteContrat'])){

        ctrlGetAllTypeAccountContract();

    }elseif (isset($_POST['supprimerType'])){

        ctrlSupprimerTypeAccount($_POST);

    }elseif (isset($_POST['ajouterType'])){

        ctrlAjouterType($_POST);

    }else{
        ctrlPageLogin();
    }
}


catch(Exception $e) {
    $msg = $e->getMessage() ; 
    ctrlErreur($msg); 
    }