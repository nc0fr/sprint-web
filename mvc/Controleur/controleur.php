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

function ctrlGetAllMotif(){
    $motif = mdlGetAllMotif();
    vueGetAllMotif($motif);
}

function ctrlModifierPiece($motif){
    if(isset($motif["modifier"]) && isset($motif["valeurModifier"])){

        if(strlen($motif["valeurModifier"]) > 0){

            $id = $motif["modifier"];
            $value = $motif["valeurModifier"];
        
            mdlModifierPiece($id, $value);
        
            vueMsgDirecteur("Le motif a bien été modifié");

        } else {
            vueMsgDirecteur("Veuillez remplir le nouveau motif");
        }

    } else {
        vueMsgDirecteur("Veuillez selectionner un motif");
    }
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

                $name = mdlGetTypeById($type["account"], "account")->nom;
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

                $name = mdlGetTypeById($type["contract"], "contract")->nom;
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

    if(strlen($newType["nom"]) > 0 && strlen($newType["nature"]) > 0 && strlen($newType["pieceCreation"]) > 0 &&
        strlen($newType["pieceModification"]) > 0 && strlen($newType["pieceSuppression"]) > 0){
            
        $nom = $newType["nom"];
        $nature = $newType["nature"];
        $pieceCreation = $newType["pieceCreation"];
        $pieceModification = $newType["pieceModification"];
        $pieceSuppression = $newType["pieceSuppression"];
        
        if(mdlGetTypeByName($nom, "account") == false && mdlGetTypeByName($nom, "contract") == false){
            
            mdlAjouterType($nature, $nom, $pieceCreation, $pieceModification, $pieceSuppression);
            
            vueMsgDirecteur('Le '.$nature.'"'.$nom.'" a bien été créer');
        } else {
            vueMsgDirecteur('Le nom "'.$nom.'" est déjà utilisé pour un type de compte ou contrat');
        }
    } else {
        vueMsgDirecteur("Tous les champs de texte n'ont pas été remplis");
    }
}
