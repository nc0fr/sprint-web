<?php

require_once 'Controleur/controleur.php';

try {
    if (isset($_POST['connexion'])) {
        ctrlVerifierId();
    } elseif (isset($_GET['action1']) == 'gestion_motifs') {
        ctrlGetAllMotif();
    } elseif (isset($_POST['modifierPiece'])) {

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
    } elseif (isset($_GET['actionConseil'])) {
        if ($_GET['actionConseil'] == 'conseiller_login_client') {
            ctrlConseillerLoginClient();
        } elseif ($_GET['actionConseil'] == 'conseiller_deconnection_client') {
            ctrlConseillerClientDeconnection();
        } elseif ($_GET['actionConseil'] == 'conseiller_inscription_client') {
            ctrlConseillerPageInscriptionClient();
        }
    } elseif (isset($_POST['conseillerLoginClient'])) {
        ctrlConseillerClient($_POST, "info");
    } elseif (isset($_POST['conseillerInscriptionClient'])) {
        ctrlConseillerInscriptionClient($_POST);
    } elseif (isset($_POST['conseillerCreationCompte'])) {
        ctrlConseillerCreationCompte($_POST);
    } elseif (isset($_POST['conseillerSouscriptionContrat'])) {
        ctrlConseillerSouscriptionContrat($_POST);
    } else {
        ctrlPageLogin();
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    ctrlErreur($msg);
}
