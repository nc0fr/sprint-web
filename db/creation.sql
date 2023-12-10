create database if not exists `Banque`;

use `Banque`;

-- Entités

create table if not exists `RendezVous`
(
    id           integer(4) not null auto_increment primary key,
    horaireDebut datetime   not null,
    horaireFin   datetime   not null

) comment = "Table des rendez-vous pour les conseillers";

create table if not exists `Motif`
(
    id            integer(4)    not null auto_increment primary key,
    libelle       varchar(64)   not null,
    justificatifs varchar(2048) not null
) comment = "Table des motifs de rendez-vous";


create table if not exists `Operation`
(
    id     integer(4)     not null auto_increment primary key,
    -- Types valides:
    -- `DEPOT`
    -- `RETRAIT`
    type   varchar(16)    not null,
    valeur decimal(10, 2) not null
) comment = "Table des opérations sur les comptes";

create table if not exists `TypeCompte`
(
    id  integer(4)  not null auto_increment primary key,
    nom varchar(32) not null
) comment = "Table des types de comptes";

create table if not exists `TypeContrat`
(
    id  integer(4)  not null auto_increment primary key,
    nom varchar(32) not null
) comment = "Table des types de contrats";

create table if not exists `Compte`
(
    id            integer(4)     not null auto_increment primary key,
    solde         decimal(10, 2) not null,
    decouvert     decimal(10, 2) not null,
    dateOuverture datetime       not null,
    dateCloture   datetime       null
) comment = "Table des comptes";

create table if not exists `Contrat`
(
    id            integer(4)     not null auto_increment primary key,
    tarifMensuel  decimal(10, 2) not null,
    dateOuverture datetime       not null,
    dateRupture   datetime       null
) comment = "Table des contrats";

create table if not exists `Client`
(
    id         integer(4)  not null auto_increment primary key,
    nom        varchar(32) not null,
    prenom     varchar(32) not null,
    adresse    varchar(64) not null,
    numTel     varchar(15) not null,
    mail       varchar(32) not null,
    profession varchar(64) null,
    situation  varchar(16) not null,
    dateAjout  datetime    not null,
    dateQuitte datetime    null
) comment = "Table des clients";

create table if not exists `Employe`
(
    id           integer(4)   not null auto_increment primary key,
    nom          varchar(32)  not null,
    prenom       varchar(32)  not null,
    login        varchar(16)  not null,
    mdp          varchar(128) not null,
    dateEmbauche datetime     not null,
    -- Types valides:
    -- `DIRECTEUR`
    -- `CONSEILLER`
    -- `AGENT`
    type         varchar(32)  not null
) comment = "Table des employés";

create table if not exists `Compte`
(
    id            integer(4)     not null auto_increment primary key,
    solde         decimal(10, 2) not null,
    decouvert     decimal(10, 2) not null,
    dateOuverture datetime       not null,
    dateCloture   datetime       null
) comment = "Table des comptes";

-- Relations

-- Relation entre un employé de type CONSEILLER et un client.
create table if not exists `EstConseillerDe`
(
    id         integer(4) not null auto_increment primary key,
    conseiller integer(4) not null,
    client     integer(4) not null,
    constraint `Fk_EstConseillerDe_conseiller`
        foreign key (conseiller) references `Employe` (id),
    constraint `Fk_EstConseillerDe_client`
        foreign key (client) references `Client` (id)
);

-- Relation entre un client et un compte.
create table if not exists `AOuvert`
(
    id     integer(4) not null auto_increment primary key,
    client integer(4) not null,
    compte integer(4) not null,
    constraint `Fk_AOuvert_client`
        foreign key (client) references `Client` (id),
    constraint `Fk_AOuvert_compte`
        foreign key (compte) references `Compte` (id)
);

-- Relation entre un client et un contrat.
create table if not exists `ASouscrit`
(
    id      integer(4) not null auto_increment primary key,
    client  integer(4) not null,
    contrat integer(4) not null,
    constraint `Fk_ASouscrit_client`
        foreign key (client) references `Client` (id),
    constraint `Fk_ASouscrit_contrat`
        foreign key (contrat) references `Contrat` (id)
);

-- Relation entre un client et un rendez-vous.
create table if not exists `APrisRendezVous`
(
    id         integer(4) not null auto_increment primary key,
    client     integer(4) not null,
    rendezVous integer(4) not null,
    constraint `Fk_APrisRendezVous_client`
        foreign key (client) references `Client` (id),
    constraint `Fk_APrisRendezVous_rendezVous`
        foreign key (rendezVous) references `RendezVous` (id)
);

-- Relation entre un rendez-vous et un employé de type CONSEILLER.
create table if not exists `ARendezVous`
(
    id         integer(4) not null auto_increment primary key,
    rendezVous integer(4) not null,
    conseiller integer(4) not null,
    constraint `Fk_ARendezVous_rendezVous`
        foreign key (rendezVous) references `RendezVous` (id),
    constraint `Fk_ARendezVous_conseiller`
        foreign key (conseiller) references `Employe` (id)
);

-- Relation entre un rendez-vous et un motif.
create table if not exists `APourMotif`
(
    id         integer(4) not null auto_increment primary key,
    rendezVous integer(4) not null,
    motif      integer(4) not null,
    constraint `Fk_APourMotif_rendezVous`
        foreign key (rendezVous) references `RendezVous` (id),
    constraint `Fk_APourMotif_motif`
        foreign key (motif) references `Motif` (id)
);

-- Relation entre un compte et un type de compte.
create table if not exists `EstDeTypeCompte`
(
    id         integer(4) not null auto_increment primary key,
    compte     integer(4) not null,
    typeCompte integer(4) not null,
    constraint `Fk_EstDeTypeCompte_compte`
        foreign key (compte) references `Compte` (id),
    constraint `Fk_EstDeTypeCompte_typeCompte`
        foreign key (typeCompte) references `TypeCompte` (id)
);

-- Relation entre un contrat et un type de contrat.
create table if not exists `EstDeTypeContrat`
(
    id          integer(4) not null auto_increment primary key,
    contrat     integer(4) not null,
    typeContrat integer(4) not null,
    constraint `Fk_EstDeTypeContrat_contrat`
        foreign key (contrat) references `Contrat` (id),
    constraint `Fk_EstDeTypeContrat_typeContrat`
        foreign key (typeContrat) references `TypeContrat` (id)
);

-- Relation entre un client et une opération.
create table if not exists `AEffectue`
(
    id        integer(4) not null auto_increment primary key,
    client    integer(4) not null,
    operation integer(4) not null,
    constraint `Fk_AEffectue_client`
        foreign key (client) references `Client` (id),
    constraint `Fk_AEffectue_operation`
        foreign key (operation) references `Operation` (id)
);

-- Relation entre un compte et une opération.
create table if not exists EffectueeSur
(
    id        integer(4) not null auto_increment primary key,
    compte    integer(4) not null,
    operation integer(4) not null,
    constraint `Fk_EffectueeSur_compte`
        foreign key (compte) references `Compte` (id),
    constraint `Fk_EffectueeSur_operation`
        foreign key (operation) references `Operation` (id)
);
