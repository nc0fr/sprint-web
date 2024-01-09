-- PRODUCTION pour la présentation en personne.
-- EXECUTER CE SCRIPT APRES CREATION.SQL
use Banque;

insert into `Employe` (nom, prenom, login, mdp, dateEmbauche, type)
values ('René', 'David', 'david.rene', 'password', '2024-01-01', 'DIRECTEUR'),
       ('Y', 'Y', 'y.y', 'password', '2024-01-08', 'CONSEILLER'),
       ('Anna', 'Olimpia', 'olimpia.anna', 'password', '2024-01-08', 'AGENT');
