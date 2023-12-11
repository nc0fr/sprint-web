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

function afficherErreur($erreur){
    $contenu='<p>'. $erreur.'</p>';
    require_once('Vue/gabaritLogin.php');
}