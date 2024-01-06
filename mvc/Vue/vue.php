<?php

//Login et choix des pages

function pageLogin(): void
{
    $contenu = '';
    require_once __DIR__ . '/gabaritLogin.php';
}

function erreurId(): void
{
    $contenu = '<p>Identifiants faux</p>';
    require_once __DIR__ . '/gabaritLogin.php';
}

function pageDirecteur(string $nom,
                       string $prenom,
                       string $type): void
{
    $contenu = "$nom $prenom<br>$type";
    require_once __DIR__ . '/gabaritDirecteur.php';
}

function pageAgent(string $nom,
                   string $prenom,
                   string $type): void
{
    $contenu = "$nom $prenom<br>$type";
    require_once __DIR__ . '/gabaritAgent.php';
}

function pageConseille(string $nom,
                       string $prenom,
                       string $type): void
{
    $contenu = "$nom $prenom<br>$type";
    require_once __DIR__ . '/gabaritConseille.php';
}

function pageGestion(): void
{
    require_once __DIR__ . '/gabaritGestionEmployes.php';
}

//Directeur -> Gestion des employés

function msgGestionEmployes(string $message): void
{
    $contenu = "<script>alert('".$message."');</script>";
    require_once __DIR__ . '/gabaritGestionEmployes.php';
}

function vueGetAllMotif(array $motif): void
{
    $contenu1 = '';
    $contenu = '<fieldset><legend>Liste des motifs</legend><form method="post" action="sprintBank.php">';

    if (count($motif) > 0) {
        $contenu .= '<ul>';

        foreach ($motif as $value) {
            $contenu .= "<td><input type='radio' name='modifier' value='$value->id'>$value->libelle<br><p>Pieces justificative : $value->justificatifs</p></td><br><br>";
        }

        $contenu .= '</ul><input type="text" name="valeurModifier"/><input type="submit" name="modifierPiece" value="Modifier le motif selectionné"/></form></fieldset>';
    }

    require_once __DIR__ . '/gabaritDirecteur.php';
}

function vueModifierPiece(array $etat): void
{
    $contenu = '';

    foreach ($etat as $val) {
        $contenu .= '<p>Etat n°'.$val.'</p>';
    }

    require_once __DIR__ . '/gabaritDirecteur.php';
}

function vueMsgDirecteur(string $msg): void
{
    $contenu = $msg;
    require_once __DIR__ . '/gabaritDirecteur.php';
}

//Directeur -> Gestion des comptes et contrats

function vueGetAllTypeAccountContract(array $account,
                                      array $contract): void
{
    $contenu = '<fieldset><legend>Liste des types de Compte</legend><form method="post" action="sprintBank.php">';

    if (count($account) > 0) {
        $contenu .= '<ul>';

        foreach ($account as $value) {
            $contenu .= '<td><input type="radio" name="account" value='.$value->id.'>'.$value->nom.'</td><br><br>';
        }

        $contenu .= '</ul><input type="submit" name="supprimerType" value="Supprimer le type de compte selectionné"/></form></fieldset>';
    }

    $contenu .= '<fieldset><legend>Liste des types de Contrat</legend><form method="post" action="sprintBank.php">';

    if (count($contract) > 0) {
        $contenu .= '<ul>';

        foreach ($contract as $value) {
            $contenu .= '<td><input type="radio" name="contract" value='.$value->id.'>'.$value->nom.'</td><br><br>';
        }

        $contenu .= '</ul><input type="submit" name="supprimerType" value="Supprimer le type de contrat selectionné"/></form></fieldset>';
    }

    $contenu .= '<form method="post" action="sprintBank.php">
                            <fieldset>
                                <legend>Creer un nouveau Type</legend>
                                <p>
                                    <label>Nature du changement :</label>
                                    <select name="nature">
                                        <option value="compte" selected>Compte</option>
                                        <option value="contrat">Contrat</option>
                                    </select>
                                </p>
                                <p>
                                    <label>Nom :</label>
                                    <input type="text" name="nom"/>
                                </p>
                                <p>
                                    <label>Pièces justificative pour Création</label>
                                    <input type="text" name="pieceCreation"/>
                                </p>
                                <p>
                                    <label>Pièces justificative pour Modification</label>
                                    <input type="text" name="pieceModification"/>
                                </p>
                                <p>
                                    <label>Pièces justificative pour Suppression</label>
                                    <input type="text" name="pieceSuppression"/>
                                </p>
                                <p>
                                    <input type="submit" name="ajouterType" value="Ajouter le type"/>
                                </p>
                            </fieldset>
                        </form>';

    require_once __DIR__ . '/gabaritDirecteur.php';
}

//Agent -> Modification clients

function msgGestionClients(string $msg): void
{
    $contenu = $msg;
    require_once __DIR__ . '/gabaritGestionClients.php';
}

function pageGestionClients(): void
{
    $contenu = '
    <p>Quel client souhaitez vous modifier ?</p>
    <p><input type="text" name="nom" placeholder="Nom" >
    <input type="text" name="prenom" placeholder="Prénom" ></p>
    <p>Renseignez uniquement les informations à changer :</p>
    <p><input type="text" name="adresse" placeholder="Nouvelle adresse" ></p>
    <p><input type="text" name="numtel" placeholder="Nouveau numéro de téléphone" ></p>
    <p><input type="text" name="email" placeholder="Nouvelle adresse mail" ></p>
    <p><input type="text" name="profession" placeholder="Nouvelle profession" ></p>
    <p><input type="text" name="situation" placeholder="Nouvelle situation familliale" ></p>
    <p><input type="submit" name="choixmodif" value="Modifier"></p>

    ';
    require_once __DIR__ . '/gabaritGestionClients.php';
}

//Erreurs PHP
function afficherErreur(Exception $erreur): void
{
    $contenu = '<p>'.$erreur.'</p>';
    require_once __DIR__. '/gabaritLogin.php';
}
