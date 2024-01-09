<?php

require_once 'Modele/connect.php';

function getConnexion()
{
    $connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD, USER, PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $requete = 'select * from `Motif`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);

    $motif = $resultat->fetchAll();

    $resultat->closeCursor();

    return $motif;
}

function mdlModifierPiece($id, $value)
{

    $connexion = getConnexion();
    $requete = 'update `Motif` set justificatifs = "'.$value.'" where id = '.intval($id);

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $resultat->fetchAll();
}

function mdlGetAllTypeAccount()
{

    $connexion = getConnexion();
    $requete = 'select * from `TypeCompte`;';

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $typeAccount = $resultat->fetchAll();
    $resultat->closeCursor();

    return $typeAccount;
}

function mdlGetAllTypeContract()
{

    $connexion = getConnexion();
    $requete = 'select * from `TypeContrat`;';

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
function mdlGetClient($client, $methode)
{
    $connexion = getConnexion();

    $requete = '';

    if ($methode == 'info') {
        $requete = 'SELECT * FROM client WHERE nom="'.$client['clientName'].'" AND prenom="'.$client['clientPrenom'].'" AND mail="'.$client['clientMail'].'"';
    } elseif ($methode == 'id') {
        $requete = 'SELECT * FROM client WHERE id='.$client.';';
    } else {
        throw new Exception('mdlGetClient : var methode not correct (info or id)');
    }

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $clientId = $resultat->fetch();
    $resultat->closeCursor();

    return $clientId;
}

function mdlInscriptionClient($client)
{
    $connexion = getConnexion();

    $requete = 'INSERT INTO
                client(nom, prenom, adresse, numTel, mail, profession, situation, dateAjout)
                VALUES
                ("'.$client['nom'].'", "'.$client['prenom'].'", "'.$client['adresse'].'", "'.$client['telephone'].'", "'.$client['email'].
        '", "'.$client['profession'].'", "'.$client['situation'].'", NOW())';
    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlGetClientCompte($client)
{
    $connexion = getConnexion();

    $requeteVIEW = 'CREATE OR REPLACE VIEW CompteClient(idCompte) AS
                    SELECT compte.id FROM compte WHERE compte.id
                    IN (SELECT aouvert.compte FROM aouvert WHERE aouvert.client = '.$client.');

                    CREATE OR REPLACE VIEW CompteClientType(idCompte, typeCompte) AS
                    SELECT compteclient.idCompte, estdetypecompte.typeCompte FROM compteclient
                    INNER JOIN estdetypecompte ON estdetypecompte.compte = compteclient.idCompte;';

    $requete = 'SELECT compte.id, compte.solde, compte.decouvert, compte.dateOuverture, typeCompte.nom FROM compte
                INNER JOIN compteclienttype ON compte.id = compteclienttype.idCompte
                INNER JOIN typeCompte ON typeCompte.id = compteclienttype.typeCompte;';

    $resultat = $connexion->query($requeteVIEW);
    $resultat->closeCursor();
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $clientCompte = $resultat->fetchAll();
    $resultat->closeCursor();

    return $clientCompte;
}

function mdlGetClientContrat($client)
{
    $connexion = getConnexion();

    $requeteVIEW = 'CREATE OR REPLACE VIEW ContratClient(idContrat) AS
                    SELECT asouscrit.contrat FROM asouscrit WHERE asouscrit.client = '.$client.';

                    CREATE OR REPLACE VIEW ContratClientType(idContrat, typeContrat) AS
                    SELECT contratclient.idContrat, estdetypecontrat.typeContrat FROM contratclient
                    INNER JOIN estdetypecontrat ON estdetypecontrat.contrat = contratclient.idContrat;';

    $requete = 'SELECT contrat.id, contrat.tarifMensuel, contrat.dateOuverture, typecontrat.nom FROM contrat
                INNER JOIN contratclienttype ON contrat.id = contratclienttype.idContrat
                INNER JOIN typeContrat ON typeContrat.id = contratclienttype.typeContrat;';

    $resultat = $connexion->query($requeteVIEW);
    $resultat->closeCursor();

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $clientContrat = $resultat->fetchAll();
    $resultat->closeCursor();

    return $clientContrat;
}

function mdlCreationCompte($clientId, $typeCompte)
{
    $connexion = getConnexion();

    $requete = 'INSERT INTO compte (solde, decouvert, dateOuverture) VALUES (0, -200, NOW());
                SET @compteId = LAST_INSERT_ID();
                INSERT INTO aouvert (client, compte) VALUES ('.$clientId.', @compteId);
                INSERT INTO estdetypecompte (compte, typeCompte) VALUES (@compteId, (SELECT id FROM typecompte WHERE nom = "'.$typeCompte.'"));';

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlSouscriptionContrat($clientId, $typeContrat, $tarif)
{
    $connexion = getConnexion();

    $requete = 'INSERT INTO contrat (tarifMensuel, dateOuverture) VALUES ('.$tarif.', NOW());
                SET @contratId = LAST_INSERT_ID();
                INSERT INTO asouscrit (client, contrat) VALUES ('.$clientId.', @contratId);
                INSERT INTO estdetypecontrat (contrat, typeContrat) VALUES (@contratId, (SELECT id FROM typeContrat WHERE nom = "'.$typeContrat.'"));';

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlSuppressionCompte($compteId)
{
    $connexion = getConnexion();

    $requete = 'CREATE OR REPLACE VIEW CompteOperation(idOperation) AS
                SELECT effectueesur.operation FROM effectueesur WHERE effectueesur.compte = '.$compteId.';

                DELETE FROM aeffectue WHERE aeffectue.operation IN (SELECT compteoperation.idOperation FROM compteoperation);
                DELETE FROM effectueesur WHERE effectueesur.compte = '.$compteId.';
                DELETE FROM operation WHERE operation.id IN (SELECT compteoperation.idOperation FROM compteoperation);
                DELETE FROM estdetypecompte WHERE compte = '.$compteId.';
                DELETE FROM aouvert WHERE compte = '.$compteId.';
                DELETE FROM compte WHERE id = '.$compteId.';';

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlSuppressionContrat($contratId)
{
    $connexion = getConnexion();

    $requete = 'DELETE FROM estdetypecontrat WHERE contrat = '.$contratId.';
                DELETE FROM asouscrit WHERE contrat = '.$contratId.';
                DELETE FROM contrat WHERE id = '.$contratId.';';

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlModificationDecouvert($compteId, $compteDecouvert)
{
    $connexion = getConnexion();

    $requete = 'UPDATE compte SET decouvert = '.$compteDecouvert.'
                WHERE id = '.$compteId.';';

    $resultat = $connexion->query($requete);
    $resultat->closeCursor();
}

function mdlCountContrats(string $debut, $fin): int
{
    $connexion = getConnexion();

    $requete = "SELECT COUNT(*) FROM `Contrat` WHERE dateOuverture BETWEEN '$debut' AND '$fin';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetch();
    $resultat->closeCursor();

    return $contrats->{'COUNT(*)'};
}

function mdlCountComptes(string $debut, $fin): int
{
    $connexion = getConnexion();

    $requete = "SELECT COUNT(*) FROM `Compte` WHERE dateOuverture BETWEEN '$debut' AND '$fin';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetch();
    $resultat->closeCursor();

    return $contrats->{'COUNT(*)'};
}

function mdlCountRdv(string $debut, $fin): int
{
    $connexion = getConnexion();

    $requete = "SELECT COUNT(*) FROM `RendezVous` WHERE horaireDebut BETWEEN '$debut' AND '$fin';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetch();
    $resultat->closeCursor();

    return $contrats->{'COUNT(*)'};
}

function mdlCountClients(string $fin): int
{
    $connexion = getConnexion();

    $requete = "SELECT COUNT(*) FROM `Client` WHERE dateAjout <= '$fin';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetch();
    $resultat->closeCursor();

    return $contrats->{'COUNT(*)'};
}

function mdlSumSolde(string $fin)
{
    $connexion = getConnexion();

    $requete = "SELECT SUM(solde) FROM `Compte` WHERE dateOuverture <= '$fin';";

    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $contrats = $resultat->fetch();
    $resultat->closeCursor();

    return $contrats->{'SUM(solde)'};
}

