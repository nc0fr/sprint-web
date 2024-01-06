<?php

require_once __DIR__ . '/../Modele/connect.php';

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

    $requete = "select login from employe where login='$login'";

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
    $requete = "INSERT INTO employe (NOM, PRENOM, LOGIN, MDP, DATEEMBAUCHE, TYPE) VALUES ('$nom', '$prenom', '$login', '$mdp', '$dateEmbauche', '$type')";

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function modifierEmploye($login, $mdp, $nom, $prenom): void
{
    $connexion = getConnexion();
    $requete = "UPDATE employe SET  login = '$login', mdp = '$mdp' WHERE nom='$nom' and prenom='$prenom'";

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlGetAllMotif(): false|array
{

    $connexion = getConnexion();
    $requete = 'SELECT * FROM `motif`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $motif = $resultat->fetchAll();

    $resultat->closeCursor();

    return $motif;
}

function mdlModifierPiece($id, $value): void
{

    $connexion = getConnexion();
    $requete = 'UPDATE motif SET justificatifs = "'.$value.'" WHERE id = '.intval($id);

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetchAll();
}

function mdlGetAllTypeAccount(): false|array
{

    $connexion = getConnexion();
    $requete = 'SELECT * FROM typecompte;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeAccount = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeAccount;
}

function mdlGetAllTypeContract(): false|array
{

    $connexion = getConnexion();
    $requete = 'select * from typecontrat;';

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
        $requete = "select * from typecompte where nom='$name'";
    } elseif ($type == 'contract') {
        $requete = "select * from typecontrat where nom='$name'";
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

    $requete = "insert into type$nature(nom) values ('$nom');"
               . "insert into motif(libelle,justificatifs) values ('Création d\'un $nom', '$pieceCreation'),"
               . "('Modification d\'un $nom' ,'$pieceModification'), ('Suppression d\'un $nom', '$pieceSuppression');";

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
        $requete = "select * from estdetypecompte where typeCompte='$id'";
    } elseif ($type == 'contract') {
        $requete = "select * from estdetypecontrat where typeContrat='$id'";
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
        $requete = "delete from typecompte where id='$id';";
    } elseif ($type == 'contract') {
        $requete = "delete from typecontrat where id='$id';";
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
        $requete = "select * from typecompte where id='$id'";
    } elseif ($type == 'contract') {
        $requete = "select * from typecontrat where id='$id'";
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

    $requete = "delete from motif where libelle = 'Création d\'un $name' or libelle = 'Modification d\'un $name' or libelle = 'Suppression d\'un $name';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $resultat->fetch();

    $resultat->closeCursor();
}

function rechercheClient($nom, $prenom): false|array
{
    $connexion = getConnexion();
    $requete = "select nom,prenom from client where nom='$nom' and prenom='$prenom'";

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
    $requete = "update client set $champs= '$valeur' where nom='$nom' and prenom='$prenom'";
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}
