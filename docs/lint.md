# Lint

Nous utilisons [pint](https://github.com/laravel/pint) pour vérifier la
conformité du code avec les standards de codage.

Pint est très opinionné, ce qui permet d'instaurer un style en commun
entre les développeurs sans tenir compte de leurs préférences
personnelles.

## Installation

Suivre les instructions d'installation de [Composer](composer.md).

## Utilisation

Il suffit d'exécuter la commande suivante pour que `print` vérifie
l'ensemble du code source :

```bash
composer lint
```

> **Note** : `composer lint` est un alias de `./vendor/bin/pint`.
