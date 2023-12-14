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

function mdlGetAllMotif(){

    $connexion = getConnexion();

    $requete="SELECT * FROM `motif`;";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $motif = $resultat->fetchAll();
    $resultat->closeCursor();
    
    return $motif;
}

function mdlModifierPiece($id, $value){

    $connexion = getConnexion();

    $requete = 'UPDATE motif SET justificatifs = "'.$value.'" WHERE id = '.intval($id);
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetchAll();
}

function mdlGetAllTypeAccount(){

    $connexion = getConnexion();

    $requete = "SELECT * FROM typecompte;";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeAccount = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeAccount;
}

function mdlGetAllTypeContract(){

    $connexion = getConnexion();

    $requete = "SELECT * FROM typecontrat;";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeContract = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeContract;
}

function mdlAjouterType($nature, $nom, $pieceCreation, $pieceModification, $pieceSuppression){
    $connexion = getConnexion();

    $requete = 'INSERT INTO type'.$nature.'(nom) VALUES("'.$nom.'");
                INSERT INTO motif (libelle, justificatifs) VALUES
                ("Création '."d'un ".$nom.'","'.$pieceCreation.'"),
                ("Modification '."d'un ".$nom.'","'.$pieceModification.'"),
                ("Suppression '."d'un ".$nom.'","'.$pieceSuppression.'");';
    
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

function  mdlTypeIsAssign($id, $type){

    $connexion = getConnexion();

    $requete = '';
    if($type == 'account'){
        $requete = 'SELECT * FROM estdetypecompte WHERE typeCompte = '.$id.';';
    }elseif($type == 'contract'){
        $requete = 'SELECT * FROM estdetypecontrat WHERE typeContrat = '.$id.';';
    }else{
        throw new Exception("Type non définie pour la requête TypeIsAssign");
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $verifIsAssign = $resultat->fetch();
    $resultat->closeCursor();

    return $verifIsAssign;
}

function mdlSupprimerType($id, $type){

    $connexion = getConnexion();
    
    $requete = '';
    if($type == 'account'){
        $requete = 'DELETE FROM typecompte WHERE id = '.$id.';';
    }elseif($type == 'contract'){
        $requete = 'DELETE FROM typecontrat WHERE id = '.$id.';';
    }else{
        throw new Exception("Type non définie pour la requête SupprimerType");
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

function mdlGetType($id, $type){

    $connexion = getConnexion();

    $requete = '';
    if($type == 'account'){
        $requete = 'SELECT * FROM typecompte WHERE id = '.$id.';';
    }elseif($type == 'contract'){
        $requete = 'SELECT * FROM typecontrat WHERE id = '.$id.';';
    }else{
        throw new Exception("Type non définie pour la requête GetType");
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $type = $resultat->fetch();
    $resultat->closeCursor();

    return $type;
}

function mdlSupprimerMotif($name){

    $connexion = getConnexion();

    $requete = 'DELETE FROM motif WHERE libelle = "Création '."d'un ".$name.
                '" OR libelle = "Modification '."d'un ".$name.
                '" OR libelle = "Suppression '."d'un ".$name.'";';
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}