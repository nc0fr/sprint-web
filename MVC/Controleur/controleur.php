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
    }else if($ligne->type =='Directeur'){
        pageDirecteur();
    }else if($ligne->type =='Agent'){
        pageAgent();
    }else if($ligne->type =='Conseille'){
        pageConseille();
    }
}




function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}