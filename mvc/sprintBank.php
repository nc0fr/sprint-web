<?php

require_once 'Controleur/controleur.php';

try {
    if (isset($_POST['connexion'])) {
        ctrlVerifierId();

    } elseif (isset($_GET['action1']) == 'gestion_motifs') {
        ctrlGetAllMotif();

    }
    //Inutile
    /*elseif (isset($_POST['showAllMotif'])){

        ctrlGetAllMotif();

    }*/ elseif (isset($_POST['modifierPiece'])) {

        ctrlModifierPiece($_POST);

    } elseif (isset($_GET['action']) == 'gestion_employes') {
        if (isset($_POST['ajtemploye'])) {
            ctrlAjouterEmploye();
        } elseif (isset($_POST['setemploye'])) {
            ctrlModifierEmploye();
        } else {
            ctrlGestion();
        }

    } elseif (isset($_GET['action2']) == 'gestion_clients') {
        if (isset($_POST['choixmodif'])) {
            ctrlModifierClient();
        } else {
            ctrlGestionClients();
        }
    } elseif (isset($_GET['action3']) == 'gestion_comptes_contrats') {

        ctrlGetAllTypeAccountContract();

    } elseif (isset($_POST['supprimerType'])) {

        ctrlSupprimerTypeAccount($_POST);

    } elseif (isset($_POST['ajouterType'])) {

        ctrlAjouterType($_POST);

    } elseif (isset($_GET['action4']) == 'operations') {
        if (isset($_POST['choixclientoperations'])) {
            ctrlOperations();
        } elseif (isset($_POST['choixcompteoperations'])) {
            ctrlEffectuerOperation();
        } else {
            ctrlPageOperations();
        }

    } elseif (isset($_GET['action5']) == 'synthese') {
        if (isset($_POST['clientsynthese'])) {
            ctrlSynthese();
        } else {
            ctrlPageSynthese();
        }

    } else {
        ctrlPageLogin();
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    ctrlErreur($msg);
}
