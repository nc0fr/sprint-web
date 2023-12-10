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

function ctrlGetAllPieces(){
    $requeteResult = mdlGetAllPieces();
}

function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}