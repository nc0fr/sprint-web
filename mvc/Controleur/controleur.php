<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');


function ctrlPageLogin(){
    pageLogin();
}

function ctrlVerifierId($usr,$mdp){
    $ligne = verifierLogin($usr,$mdp);
    if($ligne==false){
        erreurId();
    }else if($ligne->type =='DIRECTEUR'){
        pageDirecteur();
    }else if($ligne->type =='AGENT'){
        pageAgent();
    }else if($ligne->type =='CONSEILLER'){
        pageConseille();
    }
}

function ctrlGestionMotif(){
    vueGestionMotif();
}

function ctrlGetAllMotif(){
    $motif = mdlGetAllMotif();
    vueGetAllMotif($motif);
}

function ctrlModifierPiece($motif){
    $id = $motif["modifier"];
    $value = $motif["valeurModifier"];

    mdlModifierPiece($id, $value);

    vueMsgDirecteur("Le motif a bien été modifié");
}

function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}

function ctrlGetAllTypeAccountContract(){
    $account = mdlGetAllTypeAccount();
    $contract = mdlGetAllTypeContract(); 

    vueGetAllTypeAccountContract($account, $contract);
}

function ctrlSupprimerTypeAccount($type){
    if(isset($type["account"])){
        try{

            $result = mdlTypeIsAssign($type["account"], "account");

            if($result == false){

                $name = mdlGetType($type["account"], "account")->nom;
                mdlSupprimerMotif($name);
                mdlSupprimerType($type["account"], "account");
                vueMsgDirecteur('Le type de compte "'.$name.'" a bien été supprimé');

            }else{

                vueMsgDirecteur('Le type de compte ne peut être supprimé car il est assigné');

            }
        } catch (Exception $e){
            vueMsgDirecteur($e->getMessage());
        }
    }
    elseif(isset($type["contract"])){
        try{

            $result = mdlTypeIsAssign($type["contract"], "contract");

            if($result == false){

                $name = mdlGetType($type["contract"], "contract")->nom;
                mdlSupprimerMotif($name);
                mdlSupprimerType($type["contract"], "contract");
                vueMsgDirecteur('Le type de contrat "'.$name.'" a bien été supprimé');

            }else{
                vueMsgDirecteur('Le type de contrat ne peut être supprimé car il est assigné');
            }
        } catch (Exception $e){
            vueMsgDirecteur($e->getMessage());
        }
    }else{
        vueMsgDirecteur("Pour supprimer un type selectionnez un type");
    }
}

function ctrlAjouterType($newType){
    //TODO empecher création compte avec même nom
    $nature = $newType["nature"];
    $nom = $newType["nom"];
    $pieceCreation = $newType["pieceCreation"];
    $pieceModification = $newType["pieceModification"];
    $pieceSuppression = $newType["pieceSuppression"];

    mdlAjouterType($nature, $nom, $pieceCreation, $pieceModification, $pieceSuppression);

    vueMsgDirecteur("Youpi nouveau type créé");
}
