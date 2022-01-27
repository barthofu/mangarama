# Mangarama

Projet d'initiation à Symfony, réalisé dans le cadre d'un TP noté en PHP Avancé à l'IUT Info Lyon 1.

## Utilisation

Le site est disponible publiquement à l'adresse suivante : [mangarama.barthofu.com](https://mangarama.barthofu.com)

## Contenu

Toutes les consignes ou presque ont été réalisées.
Le site propose ainsi 4 pages :
- Accueil
- Informations sur un manga
- Ajout de manga
- Ajout en masse de mangas à partir d'un fichier .csv
- Statistiques

Dans la racine de ce repo, vous pourrez retrouver 2 fichiers supplémentaires :
- Un .csv exemple pour tester l'ajout en masse de mangas
- Un .sql contenant une snapshot récente de la base de données

## Environnement

L'application a été réalisée, comme induit précédement, avec le framework **Symfony**.
Pour ce qui est du front-end, j'ai décidé d'utiliser le composant **Encore** de Symfony qui propose une intégration efficace de Webpack afin notamment d'utiliser **SASS** comme pré-processeur pour le css.
Enfin, l'application a été containerisée à l'aide de **Docker**.