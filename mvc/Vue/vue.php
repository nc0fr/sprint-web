<?php


function pageLogin(){
    $contenu='';    
    require_once('Vue/gabaritLogin.php');
}

function pageDirecteur(){
    $contenu = "";
    require_once('Vue/gabaritDirecteur.php');
}

function pageAgent(){
    require_once('Vue/gabaritAgent.php');
}

function pageConseille(){
    require_once('Vue/gabaritConseille.php');
}


function erreurId(){
        $contenu ='<p>Identifiants faux</p>';
        require_once('Vue/gabaritLogin.php');
    }
    
function vueGestionMotif(){

    $contenu = '<ul>
                    <li>
                        <form method="post" action="sprintBank.php">
                            <p>
                                <input type="submit" name="showAllMotif" value="Afficher tous motifs">
                            </p>
                        </form>
                    </li>
                    <li>
                        <p>A remplir</p>
                    </li>
                </ul>';
    require_once('Vue/gabaritDirecteur.php');

}

function vueGetAllMotif($motif){
    $contenu = '<fieldset><legend>Liste des motifs</legend><form method="post" action="sprintBank.php">';
    if(sizeof($motif) > 0){
        $contenu = $contenu.'<ul>';
        foreach($motif as $value){
            $contenu = $contenu.'<td><input type="radio" name="modifier" value='.$value->id.'>'.$value->libelle.'<br><p>Pieces justificative : '.$value->justificatifs.'</p></td><br><br>';
        }
        $contenu = $contenu.'</ul><input type="text" name="valeurModifier"/>
                                <input type="submit" name="modifierPiece" value="Modifier le motif selectionné"/></form></fieldset>';
    }
    require_once('vue/gabaritDirecteur.php');
}

function vueModifierPiece($etat){
    $contenu = "";
    foreach($etat as $val){
        $contenu = $contenu.'<p>Etat n°'.$val.'</p>';
    }
    require_once('vue/gabaritDirecteur.php');
}

function vueMsgDirecteur($msg){
    $contenu = $msg;
    require_once('vue/gabaritDirecteur.php');
}

function vueGetAllTypeAccountContract($account, $contract){
    $contenu = '<fieldset><legend>Liste des types de Compte</legend><form method="post" action="sprintBank.php">';
    if(sizeof($account) > 0){
        $contenu = $contenu.'<ul>';
        foreach($account as $value){
            $contenu = $contenu.'<td><input type="radio" name="account" value='.$value->id.'>'.$value->nom.'</td><br><br>';
        }
        $contenu = $contenu.'</ul><input type="submit" name="supprimerType" value="Supprimer le type de compte selectionné"/></form></fieldset>';
    }
    $contenu = $contenu.'<fieldset><legend>Liste des types de Contrat</legend><form method="post" action="sprintBank.php">';
    if(sizeof($contract) > 0){
        $contenu = $contenu.'<ul>';
        foreach($contract as $value){
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

    require_once('vue/gabaritDirecteur.php');
}

function afficherErreur($erreur){
    $contenu='<p>'. $erreur.'</p>';
    require_once('Vue/gabaritLogin.php');
}