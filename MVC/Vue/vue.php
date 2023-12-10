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
    
function vueGestionJustificative(){

    $contenu = '<ul>
                    <li>
                        <form method="post" action="sprintBank.php">
                            <p>
                                <input type="submit" name="afficherToutesPieces" value="Afficher toutes les pièces justificative">
                            </p>
                        </form>
                    </li>
                    <li>
                        <p>A remplir</p>
                    </li>
                </ul>';
    require_once('Vue/gabaritDirecteur.php');

}

function afficherErreur($erreur){
    $contenu='<p>'. $erreur.'</p>';
    require_once('Vue/gabaritLogin.php');
}