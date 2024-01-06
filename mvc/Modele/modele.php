<?php

require_once __DIR__ . '/../Modele/connect.php';

function getConnexion()
{
    $connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD, USER, PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');

    return $connexion;
}

function verifierLogin($usr, $mdp)
{
    $connexion = getConnexion();
    $requete = "select login,mdp,nom,prenom,type from employe where login='$usr' and mdp='$mdp'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetch();
    $resultat->closeCursor();

    return $ligne;
}

function verifierAvantAjout($nom, $prenom, $login)
{
    $connexion = getConnexion();
    $requete = "select nom,prenom from employe where nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $verifPersonne = $resultat->fetch();
    $resultat->closeCursor();
    $requete = "select login from employe where login='$login'";
    $resultat = $connexion->query($requete);
    $verifLogin = $resultat->fetch();
    $resultat->closeCursor();
    $ensemble = ['personne' => $verifPersonne, 'login' => $verifLogin];

    return $ensemble;
}

function ajouterEmploye($nom, $prenom, $login, $mdp, $dateEmbauche, $type)
{
    $connexion = getConnexion();
    $requete = "INSERT INTO employe (NOM, PRENOM, LOGIN, MDP, DATEEMBAUCHE, TYPE)
    VALUES ('$nom', '$prenom', '$login', '$mdp', '$dateEmbauche', '$type')";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function modifierEmploye($login, $mdp, $nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "UPDATE employe SET  login = '$login', mdp = '$mdp' WHERE nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlGetAllMotif()
{

    $connexion = getConnexion();

    $requete = 'SELECT * FROM `motif`;';
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $motif = $resultat->fetchAll();
    $resultat->closeCursor();

    return $motif;
}

function mdlModifierPiece($id, $value)
{

    $connexion = getConnexion();

    $requete = 'UPDATE motif SET justificatifs = "'.$value.'" WHERE id = '.intval($id);
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetchAll();
}

function mdlGetAllTypeAccount()
{

    $connexion = getConnexion();

    $requete = 'SELECT * FROM typecompte;';
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeAccount = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeAccount;
}

function mdlGetAllTypeContract()
{

    $connexion = getConnexion();

    $requete = 'SELECT * FROM typecontrat;';
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeContract = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeContract;
}

function mdlGetTypeByName($name, $type)
{

    $connexion = getConnexion();

    $requete = '';
    if ($type == 'account') {
        $requete = 'SELECT * FROM typecompte WHERE nom = "'.$name.'";';
    } elseif ($type == 'contract') {
        $requete = 'SELECT * FROM typecontrat WHERE nom = "'.$name.'";';
    } else {
        throw new Exception('Type non définie pour la requête GetTypeByName');
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $queryResult = $resultat->fetch();
    $resultat->closeCursor();

    return $queryResult;
}

function mdlAjouterType($nature, $nom, $pieceCreation, $pieceModification, $pieceSuppression)
{
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

function mdlTypeIsAssign($id, $type)
{

    $connexion = getConnexion();

    $requete = '';
    if ($type == 'account') {
        $requete = 'SELECT * FROM estdetypecompte WHERE typeCompte = '.$id.';';
    } elseif ($type == 'contract') {
        $requete = 'SELECT * FROM estdetypecontrat WHERE typeContrat = '.$id.';';
    } else {
        throw new Exception('Type non définie pour la requête TypeIsAssign');
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $verifIsAssign = $resultat->fetch();
    $resultat->closeCursor();

    return $verifIsAssign;
}

function mdlSupprimerType($id, $type)
{

    $connexion = getConnexion();

    $requete = '';
    if ($type == 'account') {
        $requete = 'DELETE FROM typecompte WHERE id = '.$id.';';
    } elseif ($type == 'contract') {
        $requete = 'DELETE FROM typecontrat WHERE id = '.$id.';';
    } else {
        throw new Exception('Type non définie pour la requête SupprimerType');
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

function mdlGetTypeById($id, $type)
{

    $connexion = getConnexion();

    $requete = '';
    if ($type == 'account') {
        $requete = 'SELECT * FROM typecompte WHERE id = '.$id.';';
    } elseif ($type == 'contract') {
        $requete = 'SELECT * FROM typecontrat WHERE id = '.$id.';';
    } else {
        throw new Exception('Type non définie pour la requête GetTypeById');
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $queryResult = $resultat->fetch();
    $resultat->closeCursor();

    return $queryResult;
}

function mdlSupprimerMotif($name)
{

    $connexion = getConnexion();

    $requete = 'DELETE FROM motif WHERE libelle = "Création '."d'un ".$name.
                '" OR libelle = "Modification '."d'un ".$name.
                '" OR libelle = "Suppression '."d'un ".$name.'";';
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

function rechercheClient($nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "select nom,prenom from client where nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetchAll();

    return $ligne;
}

function modifierClient($champs, $valeur, $nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "UPDATE client SET $champs= '$valeur' WHERE nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}
