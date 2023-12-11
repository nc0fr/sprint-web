<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');


function ctrlPageLogin(){
    pageLogin();
}

function ctrlVerifierId($usr,$mdp){
    $ligne = verifierLogin($usr,$mdp);
    if($ligne==false){
        erreurId();
    }else if($ligne->type =='DIRECTEUR'){
        pageDirecteur();
    }else if($ligne->type =='AGENT'){
        pageAgent();
    }else if($ligne->type =='CONSEILLER'){
        pageConseille();
    }
}

function ctrlGestionMotif(){
    vueGestionMotif();
}

function ctrlGetAllMotif(){
    $motif = mdlGetAllMotif();
    vueGetAllMotif($motif);
}

function ctrlModifierPiece($motif){
    $id = $motif["modifier"];
    $value = $motif["valeurModifier"];

    mdlModifierPiece($id, $value);

    vueMsgDirecteur("Le motif a bien été modifié");
}

function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}