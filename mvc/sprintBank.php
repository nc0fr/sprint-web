<?php

require_once 'Controleur/controleur.php';

try {
    if (isset($_POST['connexion'])) {
        ctrlVerifierId();
    } elseif (isset($_GET['action'])) {
        if ($_GET['action'] == 'gestion_motifs') {
            ctrlGetAllMotif();
        } elseif ($_GET['action'] == 'gestion_employes') {
            if (isset($_POST['ajtemploye'])) {
                ctrlAjouterEmploye();
            } elseif (isset($_POST['setemploye'])) {
                ctrlModifierEmploye();
            } else {
                ctrlGestion();
            }
        } elseif ($_GET['action'] == 'gestion_comptes_contrats') {
            ctrlGetAllTypeAccountContract();
        } elseif ($_GET['action'] == 'statistiques') {
            ctrlStatistiques();
        } elseif ($_GET['action'] == 'gestion_clients') {
            if (isset($_POST['choixmodif'])) {
                ctrlModifierClient();
            } else {
                ctrlGestionClients();
            }
        } elseif ($_GET['action'] == 'operations') {
            if (isset($_POST['choixclientoperations'])) {
                ctrlOperations();
            } elseif (isset($_POST['choixcompteoperations'])) {
                ctrlEffectuerOperation();
            } else {
                ctrlPageOperations();
            }
        } elseif ($_GET['action'] == 'synthese') {
            if (isset($_POST['clientsynthese'])) {
                ctrlSynthese();
            } else {
                ctrlPageSynthese();
            }
        } elseif ($_GET['action'] == 'gestion_rdv'){
            ctrlGestionRdv();
            if (isset($_POST['agentRDV'])) {
                ctrlAgentPlanningConseiller();
            }

        }
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
        ctrlConseillerClient($_POST, 'info');
    } elseif (isset($_POST['conseillerInscriptionClient'])) {
        ctrlConseillerInscriptionClient($_POST);
    } elseif (isset($_POST['conseillerCreationCompte'])) {
        ctrlConseillerCreationCompte($_POST);
    } elseif (isset($_POST['conseillerSouscriptionContrat'])) {
        ctrlConseillerSouscriptionContrat($_POST);
    } elseif (isset($_POST['suppressionCompte'])) {
        ctrlConseillerSuppressionCompte($_POST);
    } elseif (isset($_POST['suppressionContrat'])) {
        ctrlConseillerSuppressionContrat($_POST);
    } elseif (isset($_POST['pageModificationDecouvert'])) {
        ctrlConseillerPageModificationDecouvert($_POST);
    } elseif (isset($_POST['retourConseillerClient'])) {
        ctrlConseillerClient($_POST['clientId'], 'id');
    } elseif (isset($_POST['modificationDecouvert'])) {
        ctrlConseillerModificationDecouvert($_POST);
    } else {
        ctrlPageLogin();
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    ctrlErreur($msg);
}
