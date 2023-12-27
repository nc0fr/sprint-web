<?php

require_once 'Modele/connect.php';

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

//Agent -> Opérations

function typeCompte($nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "SELECT tc.nom,edc.compte
                FROM client c
                JOIN aouvert ao ON c.id=ao.client
                JOIN estdetypecompte edc ON ao.compte=edc.compte
                JOIN typecompte tc ON tc.id=edc.typecompte
                WHERE c.nom='$nom' AND c.prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetchAll();

    return $ligne;
}

function verifierDecouvert($compte)
{
    $connexion = getConnexion();
    $requete = "SELECT solde,decouvert FROM compte WHERE id='$compte'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetch();

    return $ligne;
}

function effectuerOperation($compte, $montant, $op)
{
    $connexion = getConnexion();
    if ($op == 'RETRAIT') {
        $requete = "UPDATE compte SET solde=solde-'$montant' WHERE id=$compte";
    } else {
        $requete = "UPDATE compte SET solde=solde+'$montant' WHERE id=$compte";
    }
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
    $requete = "INSERT INTO operation(type, valeur) VALUES ('$op','$montant')";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
    $requete = "INSERT INTO effectueesur(compte,operation) VALUES('$compte',(SELECT MAX(id) FROM operation))";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
    $requete = "INSERT INTO aeffectue(client,operation) VALUES((SELECT client FROM aouvert WHERE compte='$compte'),(SELECT MAX(id) FROM operation))";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

//Agent -> Synthese Client

function identiteClient($nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "SELECT * FROM client WHERE nom='$nom' AND prenom='$prenom' ";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetch();

    return $ligne;
}

function syntheseClient($nom, $prenom)
{
    $connexion = getConnexion();
    $requete = "SELECT * FROM client WHERE nom='$nom' AND prenom='$prenom' ";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $client = $resultat->fetch();
    $resultat->closeCursor();

    $requete = "SELECT tc.nom 'type',edc.compte 'id',cpt.solde 'solde',cpt.dateOuverture 'date'
                FROM client c
                JOIN aouvert ao ON c.id=ao.client
                JOIN compte cpt ON ao.compte=cpt.id
                JOIN estdetypecompte edc ON ao.compte=edc.compte
                JOIN typecompte tc ON tc.id=edc.typecompte
                WHERE c.nom='$nom' AND c.prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $comptes = $resultat->fetchAll();
    $resultat->closeCursor();

    $requete = "SELECT tc.nom 'type',edc.contrat 'id',ctr.tarifMensuel 'prix',ctr.dateOuverture 'date'
                FROM client c
                JOIN asouscrit aso ON c.id=aso.client
                JOIN contrat ctr ON aso.contrat=ctr.id
                JOIN estdetypecontrat edc ON aso.contrat=edc.contrat
                JOIN typecontrat tc ON tc.id=edc.typeContrat
                WHERE c.nom='$nom' AND c.prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetchAll();
    $resultat->closeCursor();

    $requete = "SELECT e.nom 'nomC',e.prenom'prenomC'
                FROM client c JOIN
                estconseillerde ecd ON c.id=ecd.client JOIN
                employe e ON e.id=ecd.conseiller
                WHERE c.nom='$nom' AND c.prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $conseiller = $resultat->fetch();
    $resultat->closeCursor();

    $infos = ['client' => $client, 'comptes' => $comptes, 'contrats' => $contrats, 'conseiller' => $conseiller];

    return $infos;
}
