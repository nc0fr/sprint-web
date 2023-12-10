<?php
require_once('Modele/connect.php');

function getConnexion(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

function ajouterEmploye($nom,$prenom,$login,$mdp,$dateEmbauche,$type){
    $connexion=getConnexion();
    $requete = "INSERT INTO employe (NOM, PRENOM, LOGIN, MDP, DATEEMBAUCHE, TYPE)
    VALUES ('$nom', '$prenom', '$login', '$mdp', '$dateEmbauche', '$type')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}


function verifierLogin($usr,$mdp){
    $connexion=getConnexion();
    $requete="select login,mdp,type from employe where login='$usr' and mdp='$mdp'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne=$resultat->fetch();
    $resultat->closeCursor();
    return $ligne;
}

function mdlGetAllPieces(){

    $connexion = getConnexion();

    $requete="";

}
