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
        pageDirecteur($ligne->nom,$ligne->prenom,$ligne->type);
    }else if($ligne->type =='AGENT'){
        pageAgent($ligne->nom,$ligne->prenom,$ligne->type);
    }else if($ligne->type =='CONSEILLER'){
        pageConseille($ligne->nom,$ligne->prenom,$ligne->type);
    }
}






function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}