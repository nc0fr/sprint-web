# Base de donnée

Ce dossier contient les scripts de préparation de la base donnée ainsi que
certaines requêtes SQL pour créer quelques utilisateurs de tests lors du
développement de l'application.

## Base de donnée

Nous utilisons [MariaDB](https://mariadb.com), au minimum la version supportée
par XAMPP.

Lorsque vous lancez votre base de donnée, assurez-vous d'avoir le mot de passe
vide pour l'utilisateur `root` (comportement par défaut sur XAMPP).

Si vous utilisez Docker, vous pouvez utiliser la commande ci-dessous pour
créer la base de donnée.

```shell
docker pull mariadb
docker run \
  --name sprint-web \
  -e MYSQL_ROOT_PASSWORD='' \
  -e MYSQL_ALLOW_EMPTY_ROOT_PASSWORD=1 \
  -p 3306:3306 \
  -v ~/DataSprintWeb \
  mariadb
```

Pour la stopper:

```shell
docker stop sprint-web
```

Pour la relancer :

```shell
docker start sprint-web
```

## Initialisation

Après avoir lancé et créé votre base de donnée, vous pouvez l'initialiser en
créant les tables et en y insérant des données de tests.
Pour cela, vous pouvez utiliser [`creation.sql`](creation.sql) dans une requête
ou votre client SQL (phpMyAdmin, MySQL Workbench, etc.).

Le fichier [`populate.sql`](populate.sql) contient des requêtes pour insérer
des données de tests dans la base de donnée. Utile lors du développement de
l'application.