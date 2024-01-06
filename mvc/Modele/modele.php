<?php

require_once __DIR__.'/../Modele/connect.php';

function getConnexion(): PDO
{
    $host = SERVEUR;
    $dbname = BDD;
    $user = USER;
    $passwd = PASSWORD;
    $connexion = new PDO("mysql:host=$host;dbname=$dbname",
        $user, $passwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');

    return $connexion;
}

function verifierLogin(string $usr,
    string $mdp)
{
    $connexion = getConnexion();
    $requete = "select login, mdp, nom, prenom, type from `Employe` where login='$usr' and mdp='$mdp'";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $ligne = $resultat->fetch();

    $resultat->closeCursor();

    return $ligne;
}

function verifierAvantAjout(string $nom,
    string $prenom,
    string $login): array
{
    $connexion = getConnexion();
    $requete = "select nom, prenom from `Employe` where nom='$nom' and prenom='$prenom'";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $verifPersonne = $resultat->fetch();

    $resultat->closeCursor();

    $requete = "select login from `Employe` where login='$login'";

    $resultat = $connexion->query($requete);
    $verifLogin = $resultat->fetch();

    $resultat->closeCursor();

    return ['personne' => $verifPersonne, 'login' => $verifLogin];
}

function ajouterEmploye($nom,
    $prenom,
    $login,
    $mdp,
    $dateEmbauche,
    $type): void
{
    $connexion = getConnexion();
    $requete = "insert into `Employe` (NOM, PRENOM, LOGIN, MDP, DATEEMBAUCHE, TYPE) values ('$nom', '$prenom', '$login', '$mdp', '$dateEmbauche', '$type')";

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function modifierEmploye($login, $mdp, $nom, $prenom): void
{
    $connexion = getConnexion();
    $requete = "update `Employe` set  login = '$login', mdp = '$mdp' where nom='$nom' and prenom='$prenom'";

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlGetAllMotif(): false|array
{

    $connexion = getConnexion();
    $requete = 'select * from `Motif`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $motif = $resultat->fetchAll();

    $resultat->closeCursor();

    return $motif;
}

function mdlModifierPiece($id, $value): void
{

    $connexion = getConnexion();
    $requete = 'update `Motif` set justificatifs = "'.$value.'" where id = '.intval($id);

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetchAll();
}

function mdlGetAllTypeAccount(): false|array
{

    $connexion = getConnexion();
    $requete = 'select * from `TypeCompte`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeAccount = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeAccount;
}

function mdlGetAllTypeContract(): false|array
{

    $connexion = getConnexion();
    $requete = 'select * from `TypeContrat`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeContract = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeContract;
}

/**
 * @throws Exception
 */
function mdlGetTypeByName($name, $type)
{
    $connexion = getConnexion();

    if ($type == 'account') {
        $requete = "select * from `TypeCompte` where nom='$name'";
    } elseif ($type == 'contract') {
        $requete = "select * from `TypeContrat` where nom='$name'";
    } else {
        throw new Exception('Type non définie pour la requête GetTypeByName');
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $queryResult = $resultat->fetch();
    $resultat->closeCursor();

    return $queryResult;
}

function mdlAjouterType($nature,
    $nom,
    $pieceCreation,
    $pieceModification,
    $pieceSuppression): void
{
    $connexion = getConnexion();

    $table = $nature == 'Compte' ? 'TypeCompte' : 'TypeContrat';

    $requete = "insert into `$table` (nom) values ('$nom');"
               ."insert into motif(libelle,justificatifs) values ('Création d\'un $nom', '$pieceCreation'),"
               ."('Modification d\'un $nom' ,'$pieceModification'), ('Suppression d\'un $nom', '$pieceSuppression');";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

/**
 * @throws Exception
 */
function mdlTypeIsAssign($id, $type)
{
    $connexion = getConnexion();

    if ($type == 'account') {
        $requete = "select * from `EstDeTypeCompte` where typeCompte='$id'";
    } elseif ($type == 'contract') {
        $requete = "select * from `EstDeTypeContrat` where typeContrat='$id'";
    } else {
        throw new Exception('Type non définie pour la requête TypeIsAssign');
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $verifIsAssign = $resultat->fetch();

    $resultat->closeCursor();

    return $verifIsAssign;
}

/**
 * @throws Exception
 */
function mdlSupprimerType($id, $type): void
{

    $connexion = getConnexion();

    if ($type == 'account') {
        $requete = "delete from `TypeCompte` where id='$id';";
    } elseif ($type == 'contract') {
        $requete = "delete from `TypeContrat` where id='$id';";
    } else {
        throw new Exception('Type non définie pour la requête SupprimerType');
    }
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetch();
    $resultat->closeCursor();
}

/**
 * @throws Exception
 */
function mdlGetTypeById($id, $type)
{
    $connexion = getConnexion();

    if ($type == 'account') {
        $requete = "select * from `TypeCompte` where id='$id'";
    } elseif ($type == 'contract') {
        $requete = "select * from `TypeContrat` where id='$id'";
    } else {
        throw new Exception('Type non définie pour la requête GetTypeById');
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $queryResult = $resultat->fetch();

    $resultat->closeCursor();

    return $queryResult;
}

function mdlSupprimerMotif($name): void
{

    $connexion = getConnexion();

    $requete = "delete from `Motif` where libelle = 'Création d\'un $name' or libelle = 'Modification d\'un $name' or libelle = 'Suppression d\'un $name';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $resultat->fetch();

    $resultat->closeCursor();
}

function rechercheClient($nom, $prenom): false|array
{
    $connexion = getConnexion();
    $requete = "select nom,prenom from `Client` where nom='$nom' and prenom='$prenom'";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    return $resultat->fetchAll();
}

function modifierClient($champs,
    $valeur,
    $nom,
    $prenom): void
{
    $connexion = getConnexion();
    $requete = "update `Client` set $champs= '$valeur' where nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function totalArgent(): float
{
    $connexion = getConnexion();
    $requete = 'select sum(solde) from `Compte`;';
    $resultat = $connexion->query($requete);

    return $resultat->fetchColumn(0);
}

function nbComptes(): int
{
    $connexion = getConnexion();
    $requete = 'select count(id) from `Compte`;';
    $resultat = $connexion->query($requete);

    return $resultat->fetchColumn(0);
}

function nbContrats(): int
{
    $connexion = getConnexion();
    $requete = 'select count(id) from `Contrat`;';
    $resultat = $connexion->query($requete);

    return $resultat->fetchColumn(0);
}

function nbClients(): int
{
    $connexion = getConnexion();
    $requete = 'select count(id) from `Client`;';
    $resultat = $connexion->query($requete);

    return $resultat->fetchColumn(0);
}

function nbEmployes(): int
{
    $connexion = getConnexion();
    $requete = 'select count(id) from `Employe`;';
    $resultat = $connexion->query($requete);

    return $resultat->fetchColumn(0);
}
