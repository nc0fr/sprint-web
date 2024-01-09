<?php

//Login et choix des pages

function pageLogin()
{
    $contenu = '';
    require_once 'Vue/gabaritLogin.php';
}

function erreurId()
{
    $contenu = '<p>Identifiants faux</p>';
    require_once 'Vue/gabaritLogin.php';
}

function pageDirecteur($nom, $prenom, $type)
{
    $contenu = '';
    $contenu1 = $nom.' '.$prenom.'<br>'.$type;
    require_once 'Vue/gabaritDirecteur.php';
}

function pageAgent($nom, $prenom, $type)
{
    $contenu1 = $nom.' '.$prenom.'<br>'.$type;
    require_once 'Vue/gabaritAgent.php';
}

function pageConseille($nom, $prenom, $type)
{
    $contenuInfoConseiller = $nom.' '.$prenom.'<br>'.$type;
    $contenuNavBar = '<a href="?actionConseil=conseiller_login_client"><div class="item">Authentification Client</div></a>';
    require_once 'Vue/gabaritConseille.php';
}

//Directeur -> Gestion des employés

function gestionEmployes()
{
    $contenu = '
    <form method="post" class="formulaire">
    <fieldset class="ajouter">
        <h2>Ajouter Employé</h2>
        <p><input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required></p>
        <p><input type="text" name="login" placeholder="Nom d\'utilisateur"
                  required>
            <input type="password" name="mdp" placeholder="Mot de passe"
                   required></p>
        <p><h4>Directeur</h4><input type="radio" name="poste" value="DIRECTEUR"
                                    required>
        <h4>Agent</h4><input type="radio" name="poste" value="AGENT" required>
        <h4>Conseiller</h4><input type="radio" name="poste" value="CONSEILLER"
                                  required></p>
        <h4>Date d\'embauche</h4><input type="datetime-local"
                                       name="dateembauche">
        <p><input type="submit" name="ajtemploye" value="Ajouter"></p>
    </fieldset>
    </form>

    <form method="post" class="formulaire">
        <fieldset class="modifier">
            <h2>Modifier Identifiants</h2>
            <p><input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required></p>
            <p><input type="text" name="login" placeholder="Nom d\'utilisateur" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required></p>
            <p><input type="submit" name="setemploye" value="Modifier"></p>
    </fieldset>
    </form>';
    require_once 'Vue/gabaritDirecteur.php';
}

function msgGestionEmployes($message)
{
    $contenu = "<script>alert('".$message."');</script>";
    require_once 'Vue/gabaritGestionEmployes.php';
}

function vueGetAllMotif($motif)
{
    $contenu1 = '';
    $contenu = '<fieldset><legend>Liste des motifs</legend><form method="post" action="sprintBank.php">';
    if (count($motif) > 0) {
        $contenu = $contenu.'<ul>';
        foreach ($motif as $value) {
            $contenu = $contenu.'<td><input type="radio" name="modifier" value='.$value->id.'>'.$value->libelle.'<br><p>Pieces justificative : '.$value->justificatifs.'</p></td><br><br>';
        }
        $contenu = $contenu.'</ul><input type="text" name="valeurModifier"/>
                                <input type="submit" name="modifierPiece" value="Modifier le motif selectionné"/></form></fieldset>';
    }
    require_once 'vue/gabaritDirecteur.php';
}

function vueModifierPiece($etat)
{
    $contenu = '';
    foreach ($etat as $val) {
        $contenu = $contenu.'<p>Etat n°'.$val.'</p>';
    }
    require_once 'vue/gabaritDirecteur.php';
}

function vueMsgDirecteur($msg)
{
    $contenu = $msg;
    require_once 'vue/gabaritDirecteur.php';
}

//Directeur -> Gestion des comptes et contrats

function vueGetAllTypeAccountContract($account, $contract)
{
    $contenu = '<fieldset><legend>Liste des types de Compte</legend><form method="post" action="sprintBank.php">';
    if (count($account) > 0) {
        $contenu = $contenu.'<ul>';
        foreach ($account as $value) {
            $contenu = $contenu.'<td><input type="radio" name="account" value='.$value->id.'>'.$value->nom.'</td><br><br>';
        }
        $contenu = $contenu.'</ul><input type="submit" name="supprimerType" value="Supprimer le type de compte selectionné"/></form></fieldset>';
    }
    $contenu = $contenu.'<fieldset><legend>Liste des types de Contrat</legend><form method="post" action="sprintBank.php">';
    if (count($contract) > 0) {
        $contenu = $contenu.'<ul>';
        foreach ($contract as $value) {
            $contenu = $contenu.'<td><input type="radio" name="contract" value='.$value->id.'>'.$value->nom.'</td><br><br>';
        }
        $contenu = $contenu.'</ul><input type="submit" name="supprimerType" value="Supprimer le type de contrat selectionné"/></form></fieldset>';
    }

    $contenu = $contenu.'<form method="post" action="sprintBank.php">
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

    require_once 'vue/gabaritDirecteur.php';
}

//Agent -> Modification clients

function msgGestionClients($msg)
{
    $contenu = $msg;
    require_once 'Vue/gabaritGestionClients.php';
}

function pageGestionClients()
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
    require_once 'Vue/gabaritAgent.php';
}

//Agent -> Opérations

function pageOperations()
{
    $contenu = '
    <p>Insérez le nom du client :</p>
    <p><input type="text" name="nom" placeholder="Nom" >
    <input type="text" name="prenom" placeholder="Prénom" ></p>
    <p><input type="submit" name="choixclientoperations" value="Valider"></p>';
    require_once 'Vue/gabaritAgent.php';
}

function pageOperationsCompte($ligne)
{
    $contenu = '<p>Choisissez le compte souhaité :</p>
    <p><select id="choixcompte" name="choixcompte"></p>';
    if (count($ligne) > 0) {
        foreach ($ligne as $value) {
            $contenu .= ' <option value="'.$value->compte.'">'.$value->nom.'</option>';
        }
        $contenu .= '</select>
        <p>Choisissez l\'opération à effectuer :</p>
        <p><select id="choixoperation" name="choixoperation"></p>
        <option value="DEPOT">Dépot</option>
        <option value="RETRAIT">Retrait</option>
        </select>
        <p><input type="number" name="montant" placeholder="Montant" ></p>';
        $contenu .= '<p><input type="submit" name="choixcompteoperations" value="Valider"></p>';
    }
    require_once 'Vue/gabaritAgent.php';

}

function msgOperations($msg)
{
    $contenu = $msg;
    require_once 'Vue/gabaritAgent.php';
}

//Agent => Synthese Client

function pageSynthese()
{
    $contenu = '
    <p>Entrez l\'identité du client :</p>
    <p><input type="text" name="nom" placeholder="Nom" >
    <input type="text" name="prenom" placeholder="Prénom" ></p>
    <p><input type="submit" name="clientsynthese" value="Synthèse client"></p>';
    require_once 'Vue/gabaritAgent.php';
}

function infosClient($infos)
{
    $client = $infos['client'];
    $comptes = $infos['comptes'];
    $contrats = $infos['contrats'];
    $conseiller = $infos['conseiller'];
    $contenu = '
    <fieldset><legend>Identité client</legend>
    <p><label>Nom : </label><label>'.$client->nom.'</label></p>
    <p><label>Prénom : </label><label>'.$client->prenom.'</label></p>
    <p><label>Adresse : </label><label>'.$client->adresse.'</label></p>
    <p><label>Numéro de téléphone : </label><label>'.$client->numTel.'</label></p>
    <p><label>Profession : </label><label>'.$client->profession.'</label></p>
    <p><label>Situation : </label><label>'.$client->situation.'</label></p>
    <p><label>Client depuis le : </label><label>'.$client->dateAjout.'</label></p>
    <p><label>Conseiller assigné : </label><label>'.$conseiller->nomC.' '.$conseiller->prenomC.'</label></p>
    </fieldset>
    <fieldset><legend>Comptes ouverts</legend>
    <table>
    <tr><th>Type de compte</th><th>Date d\'ouverture</th><th>Solde</th></tr>
    ';
    foreach ($comptes as $value) {
        $contenu .= '<tr><td>'.$value->type.'</td>
                   <td>'.$value->date.'</td>
                   <td>'.$value->solde.' €</td></tr>';
    }
    $contenu .= '</table></fieldset>';
    $contenu .= '<fieldset><legend>Contrats souscrits</legend>';

    if ($contrats == false) {
        $contenu .= '<label>Aucun contrat souscris pour ce client.</label>';
    } else {
        $contenu .= '<table><tr><th>Type de contrat</th><th>Date de souscription</th><th>Tarif mensuel</th></tr>';
        foreach ($contrats as $value) {
            $contenu .= '<tr><td>'.$value->type.'</td>
            <td>'.$value->date.'</td>
            <td>'.$value->prix.' €</td></tr>';
        }
    }
    $contenu .= '</table></fieldset>
    TODO Bonus : Ajout section rdv  à venir ';

    require_once 'gabaritAgent.php';

}

function msgSynthese($msg)
{
    $contenu = $msg;
    require_once 'Vue/gabaritAgent.php';
}

//Conseiller
function vueConseillerLoginClient()
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_login_client"><div class="item">Authentification Client</div></a>';
    $contenu = '<div>
                    <form method="post" action="sprintBank.php">
                        <fieldset>
                            <legend>Authentification Client</legend>
                            <p>
                                <label>Nom :</label>
                                <input type="text" name="clientName" required/>
                            </p>
                            <p>
                                <label>Prénom :</label>
                                <input type="text" name="clientPrenom" required/>
                            </p>
                            <p>
                                <label>Adresse E-Mail :</label>
                                <input type="text" name="clientMail" required/>
                            </p>
                            <p>
                                <input type="submit" name="conseillerLoginClient" value="Chercher le client"/>
                            </p>
                        </fieldset>
                    </form>
                </div>';
    require_once 'Vue/gabaritConseille.php';
}

function vueConseillerClient($client, $clientCompte, $clientContrat, $allCompte, $allContrat) //TODO Ajouter la recherche de type compte contrat au menu select via requete
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_deconnection_client"><div class="item">Deconnection Client</div></a>';
    if (isset($client)) {
        $contenu = '<div>
                        <fieldset>
                            <legend>Client</legend>
                            <p>
                                Id : '.$client->id.'
                            </p>
                            <p>
                                Nom : '.$client->nom.'
                            </p>
                            <p>
                                Prénom : '.$client->prenom.'
                            </p>
                            <p>
                                E-mail : '.$client->mail.'
                            </p>
                            <p>
                                Numéro de téléphone : '.$client->numTel.'
                            </p>
                        </fieldset>
                    </div>';
        if ($clientCompte != false) {
            $contenu = $contenu.'<div>
                                    <form method="post" action="sprintBank.php">
                                        <fieldset>
                                            <legend>Compte</legend>
                                                <p>
                                                    <label>Id Client :</label>
                                                    <input type="text" name="clientId" value="'.$client->id.'" readonly/>
                                                </p>';

            foreach ($clientCompte as $compte) {
                $contenu = $contenu.'<p>
                                        <input type="radio" name="radioCompte" value="'.$compte->id.'" required/>
                                        Type de Compte : '.$compte->nom.' | Solde : '.$compte->solde.' | Découvert : '.$compte->decouvert.' | Date d'."'".'ouverture : '.$compte->dateOuverture.'/>
                                    </p>';
            }
            $contenu = $contenu.'   <input type="submit" name="suppressionCompte" value="Supprimer le compte"/>
                                    <input type="submit" name="pageModificationDecouvert" value="Modifier le découvert"/>
                                </form></fieldset></div>';
        } else {
            $contenu = $contenu.'<p>OSKUR</p>';
        }

        $contenu = $contenu.'<div>
                                <form method="post" action="sprintBank.php">
                                    <fieldset>
                                        <legend>Ouvrir un compte</legend>
                                        <p>
                                            <label>Id Client :</label>
                                            <input type="text" name="clientId" value="'.$client->id.'" readonly/>
                                        </p>
                                        <p>
                                            <label>Type de compte</label>
                                            <select name="compteType" required>';

        foreach ($allCompte as $compte) {
            $contenu = $contenu.'<option value="'.$compte->nom.'">'.$compte->nom.'</option>';
        }

        $contenu = $contenu.'               </select>
                                        </p>
                                        <input type="submit" name="conseillerCreationCompte" value="Créer le compte"/>
                                    </fieldset>
                                </form>
                            </div>';

        if ($clientContrat != false) {
            $contenu = $contenu.'<div>
                                    <form method="post" action="sprintBank.php">
                                        <fieldset>
                                            <legend>Contrat</legend>
                                            <p>
                                                <label>Id Client :</label>
                                                <input type="text" name="clientId" value="'.$client->id.'" readonly/>
                                            </p>';

            foreach ($clientContrat as $contrat) {
                $contenu = $contenu.'<p>
                                        <input type="radio" name="radioContrat" value="'.$contrat->id.'" required/>
                                        Type de Contrat : '.$contrat->nom.' | Tarif Mensuel : '.$contrat->tarifMensuel.' | Date d'."'".'ouverture : '.$contrat->dateOuverture.'
                                    </p>';
            }
            $contenu = $contenu.'<input type="submit" name="suppressionContrat" value="Supprimer le contrat"/>
                                </form></fieldset></div>';
        }

        $contenu = $contenu.'<div>
                                <form method="post" action="sprintBank.php">
                                    <fieldset>
                                        <legend>Souscrire un contrat</legend>
                                        <p>
                                            <label>Id Client :</label>
                                            <input type="text" name="clientId" value="'.$client->id.'" readonly/>
                                        </p>
                                        <p>
                                            <label>Type de contrat</label>
                                            <select name="contratType" required>';

        foreach ($allContrat as $contrat) {
            $contenu = $contenu.'<option value="'.$contrat->nom.'">'.$contrat->nom.'</option>';
        }

        $contenu = $contenu.'               </select>
                                        </p>
                                        <p>
                                            <label>Montant du tarif mensuel :</label>
                                            <input type="number" name="contratTarif" value="75" required/>
                                        </p>
                                        <input type="submit" name="conseillerSouscriptionContrat" value="Souscrire le contrat"/>
                                    </fieldset>
                                </form>
                            </div>';

        require_once 'Vue/gabaritConseille.php';
    } else {
        throw new Exception('Aucun client passée en paramètre');
    }
}

function vueConseillerClientDeconnection()
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_login_client"><div class="item">Authentification Client</div></a>';
    require_once 'Vue/gabaritConseille.php';
}

function vueConseillerInscriptionClient()
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_login_client"><div class="item">Authentification Client</div></a>';
    $contenu = '<div>
                    <form method="post" action="sprintBank.php">
                        <fieldset>
                            <legend>Inscription Client</legend>
                            <p>
                                <label>Nom :</label>
                                <input type="text" name="nom" required/>
                            </p>
                            <p>
                                <label>Prénom :</label>
                                <input type="text" name="prenom" required/>
                            </p>
                            <p>
                                <label>Adresse :</label>
                                <input type="text" name="adresse" required/>
                            </p>
                            <p>
                                <label>Numéro de téléphone :</label>
                                <input type="tel" name="telephone" required/>
                            </p>
                            <p>
                                <label>E-mail :</label>
                                <input type="email" name="email" required/>
                            </p>
                            <p>
                                <label>Profession :</label>
                                <input type="text" name="profession" required/>
                            </p>
                            <p>
                                <label>Situation familiale:</label>
                                <select name="situation" required>
                                    <option value="Marié" selected>Marié</option>
                                    <option value="Célibataire">Célibataire</option>
                                    <option value="Divorcé">Divorcé</option>
                                </select>
                            </p>
                            <p>
                                <input type="submit" name="conseillerInscriptionClient" value="Inscrire le Client"/>
                            </p>
                        </fieldset>
                    </form>
                </div>';
    require_once 'Vue/gabaritConseille.php';
}

function vueConseillerMsg($message)
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_login_client"><div class="item">Authentification Client</div></a>';
    $contenu = $message;
    require_once 'Vue/gabaritConseille.php';
}

function vueConseillerPageModificationDecouvert($clientId, $compteId)
{
    $contenuNavBar = '<a href="?actionConseil=conseiller_deconnection_client"><div class="item">Deconnection Client</div></a>';
    $contenu = '<form method="post" action="sprintBank.php">
                    <fieldset>
                        <legend>Modification de découvert</legend>
                        <p>
                            <label>Id Client :</label>
                            <input type="text" name="clientId" value="'.$clientId.'" readonly/>
                        </p>
                        <p>
                            <label>Id Compte :</label>
                            <input type="text" name="compteId" value="'.$compteId.'" readonly/>
                        </p>
                        <p>
                            <label>Nouveau montant de découvert :</label>
                            <input type="number" name="compteDecouvert" value="-200" max="0" required/>
                        </p>
                        <input type="submit" name="modificationDecouvert" value="Changer le découvert"/>
                        <input type="submit" name="retourConseillerClient" value="Retourner à la page Client"/>
                    </fieldset>
                </form>';

    require_once 'Vue/gabaritConseille.php';
}

function vueStatistiques(string $debut, string $fin, int $contrats, int $comptes, int $rdv, int $clients, float $solde): void
{
    $contenu = '<form method="post" action="?action=statistiques">';
    $contenu .= '<fieldset><legend>Statistiques de la banque</legend>';
    $contenu .= '<p><label for="debut">Entre le </label><input type="date" id="debut" name="debut" value="'.$debut.'" min="'.$debut.'" max="'.$fin.'">';
    $contenu .= '<label for="fin"> et le </label><input type="date" id="fin" name="fin" value="'.$fin.'" min="'.$debut.'" max="'.$fin.'"></p>';
    $contenu .= '<p><input type="submit" name="statistiques" value="Actualiser"></p>';
    $contenu .= '<ul>';
    $contenu .= "<li>Nombre de contrats souscris : $contrats</li>";
    $contenu .= "<li>Nombre d'ouverture de comptes : $comptes</li>";
    $contenu .= "<li>Nombre de rendez-vous pris : $rdv</li>";
    $contenu .= "<li>Nombre total de client : $clients</li>";
    $contenu .= "<li>Solde total des clients : $solde euros</li>";
    $contenu .= '</ul>';
    $contenu .= '</fieldset></form>';

    require_once 'Vue/gabaritDirecteur.php';
}

//Erreurs PHP
function afficherErreur($erreur)
{
    $contenu = '<p>'.$erreur.'</p>';
    require_once 'Vue/gabaritLogin.php';
}
