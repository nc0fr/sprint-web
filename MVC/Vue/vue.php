<?php


function pageLogin(){
    $contenu='';    
    require_once('Vue/gabaritLogin.php');
}

function pageDirecteur($nom,$prenom,$type){
    $contenu=$nom.' '.$prenom.'<br>'.$type;
    require_once('Vue/gabaritDirecteur.php');
}

function pageAgent($nom,$prenom,$type){
    $contenu=$nom.' '.$prenom.'<br>'.$type;
    require_once('Vue/gabaritAgent.php');
}

function pageConseille($nom,$prenom,$type){
    $contenu=$nom.' '.$prenom.'<br>'.$type;
    require_once('Vue/gabaritConseille.php');
}


function erreurId(){
        $contenu ='<p>Identifiants faux</p>';
        require_once('Vue/gabaritLogin.php');
    }
    

function afficherErreur($erreur){
    $contenu='<p>'. $erreur.'</p>';
    require_once('Vue/gabaritLogin.php');
}