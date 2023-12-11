# Composer

[Composer](https://getcomposer.org/) est le gestionnaire de dépendances
le plus connu pour PHP. Il permet de déclarer et d'installer
automatiquement les outils et modules dont le projet a besoin.

Nous utilisons Composer pour installer les outils de développement.

## Installation

### Windows

Télécharger et installer [Composer](https://getcomposer.org/download/).

### Mac OS

Utiliser [Homebrew](https://brew.sh/) pour installer Composer.

```bash
brew install composer
```

## Dépendances

Les dépendances sont déclarées dans le fichier
[`composer.json`](../composer.json) à la racine du projet.
Pour installer les dépendances, exécuter la commande suivante :

```bash
composer install
```

Celà va créer un dossier `vendor` contenant les dépendances (dossier à
ne pas inclure dans le dépôt Git).
