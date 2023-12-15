<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');


//Page login
function ctrlPageLogin(){
    pageLogin();
}

function ctrlVerifierId(){
    $usr=$_POST['login'];
    $mdp=$_POST['mdp'];
    $ligne = verifierLogin($usr,$mdp);
    if($ligne==false){
        erreurId();
    }else if($ligne->type =='DIRECTEUR'){
        pageDirecteur($ligne->nom,$ligne->prenom,$ligne->type);
    }else if($ligne->type =='AGENT'){
        pageAgent($ligne->nom,$ligne->prenom,$ligne->type);
    }else if($ligne->type =='CONSEILLER'){
        pageConseille($ligne->nom,$ligne->prenom,$ligne->type);
    }
}


//Gestion des employés
function ctrlGestion(){
    pageGestion();
}

function ctrlAjouterEmploye(){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $dateEmbauche=$_POST['dateembauche'];
    $type=$_POST['poste'];
    $ensemble=verifierAvantAjout($nom,$prenom,$login);
    if($ensemble['personne']!=false){
        msgGestionEmployes("Personne déjà existante !");
    }elseif($ensemble['login']!=false){
        msgGestionEmployes("Login déjà utilisé !");
    }else{
        ajouterEmploye($nom,$prenom,$login,$mdp,$dateEmbauche,$type);
        msgGestionEmployes("Nouvel employé ajouté !");
    }

}

function  ctrlModifierEmploye(){
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $ensemble=verifierAvantAjout($nom,$prenom,$login);
    if($ensemble['personne']==false){
        msgGestionEmployes("Aucun employé ne correspond à votre saisis.");
    }
    elseif($ensemble['login']!=false){
        msgGestionEmployes("Login déjà utilisé !");
    }
    else{
        modifierEmploye($login,$mdp,$nom,$prenom);
        msgGestionEmployes("Identifiants changés !");
    }
}

//Gestion des motifs
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


//Comptes et contrats
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



    //Agent -> Modification clients


    function ctrlGestionClients(){
        pageGestionClients();
    }
    
    
    
    function ctrlModifierClient(){
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $ligne=rechercheClient($nom,$prenom);
            if($ligne!=false){
                $changements='Changements effectués pour '.$nom.' '.$prenom.' : ';
                if(!empty($_POST['adresse'])){
                    modifierClient('adresse',$_POST['adresse'],$nom,$prenom);
                    $changements.='| Adresse |';
                }if(!empty($_POST['numtel'])){
                    modifierClient('numTel',$_POST['numtel'],$nom,$prenom);
                    $changements.='| Numéro de téléphone |';
                }if(!empty($_POST['email'])){
                    modifierClient('mail',$_POST['email'],$nom,$prenom);
                    $changements.='| Adresse mail |';
                }if(!empty($_POST['profession'])){
                    modifierClient('profession',$_POST['profession'],$nom,$prenom);
                    $changements.='| Profession |';
                }if(!empty($_POST['situation'])){
                    modifierClient('situation',$_POST['situation'],$nom,$prenom);
                    $changements.='| Situation |';
                }
                
                msgGestionClients('<p>
                    '. $changements .'</p>
                    <p><input type="submit" name="retour" value="Retour"></p>');
            }else{
                msgGestionClients('<p>
                Aucun client trouvé, vérifiez votre saisie.</p>
                <p><input type="submit" name="reessayer" value="Réessayer"></p>');
            }     
    }
    


//Erreurs
function ctrlErreur($erreur){
    afficherErreur($erreur) ;
}