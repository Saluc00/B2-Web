# Documentation

*Projet web de fin d'année, reprenant le concept de Spotify.*

*Mettre à disposition des échantillons de musique, depuis l'API de Deezer. Création de compte, playlist, possibilité de mettre en coup de cœur des titres, album, playlist, artiste.*
*Un page d'administration permet de gérer les utilisateurs et les playlists qu'ils ont créé.*

## Sommaire

* [Livrable](##-livrable)
	* [Présentation](###-présentation)
	* [Site](###-site)
* [Installer le projet](##-installer-le-projet)
	* [Pré-requis](###-pré-requis)
		* [Software](####-software)
	* [Installation](###-installer)
		* [Git clone](####-git-clone)
		* [Create database](####-create-database)
* [Architecture du site](##-architecture-du-site)
* [structure de la base de données](##-structure-de-la-base-de-données)

## Livrable

### Présentation

[Lien vers la présentation](https://www.canva.com/design/DAD5XDEpSCA/pXX9L8M1F0l0aUdGYUNkRA/edit?category=tACFasDnyEQ)

[Liens vers le PDF de la présentation](https://github.com/Saluc00/B2-Web/tree/master/présentation/presentation.pdf) 

### Site

https://github.com/Saluc00/B2-Web/tree/master/Site

## Installer le projet

### Pré-requis

#### Software

- OS Linux
- Vagrant
- Homestead
- Composer
- PHP
- Git
- NGINX
- NPM
- Laravel
- MYSQL

### Installation

#### Git clone

```
git clone https://github.com/Saluc00/B2-Web.git
```

#### Create database

```
mysql
CREATE DATABASE projet
exit
```

#### Migration

Une fois dans le projet laravel, entrer la commande: 

```
php artisan migrate
```

## Architecture du site
![arch](https://github.com/Saluc00/B2-Web/blob/master/images/architecture.png)
## Structure de la base de données
![bdd](https://github.com/Saluc00/B2-Web/blob/master/images/schema.png)