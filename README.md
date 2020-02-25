# Twitter Laravel

Application de page unique de type Twitter avec Laravel, avec une chronologie se mettant à jour automatiquement, la possibilité de follow/unfollow des utilisateurs et une authentification basique avec Avatar ou non.

## Guide utilisateur

### Page de bienvenue

-   Modification de la page d'accueil basique de Laravel par une page d'accueil avec un design épuré correspondant à notre application.

    -   Bienvenue sur Twitter Laravel
    -   Un bouton d'inscription (S'inscrire)
    -   Un bouton d'identification (S'identifier)

![docs/Welcome.jpg](docs/Welcome.jpg)

### Authentification

-   Modification du système d'authentification de Laravel (inscription, connexion) pour utiliser un nom (name) et un nom d'utilisateur ou pseudo (pseudo) avec ou sans avatar (avatar). Un avatar par défault sera utilisé à la création du compte utilisateur et le pseudo ainsi que l'adresse e-mail est unique.

    -   Ex: Avatar - John Do - @johnDo.
        ![docs/inscription.jpg](docs/inscription.jpg)

        ![docs/login.jpg](docs/login.jpg)

### Page d'accueil

A la création du compte ou à l'identification, nous arrivons sur la page d'accueil de l'application.

-   Un menu de navigation est accessible sur toutes les pages une fois la connexion effectuée avec quelques options :
    -   Le titre de l'application 'Twitter Laravel' ramenant sur la page de bienvenue.
    -   Votre nom ou pseudo permettant d'accéder à un sous-menu déroulant comportant les actions suivantes :
        1. Un bouton de "Se déconnecter" redirigeant l'utilisateur sur la page de bienvenue, en le déconnectant.
        2. Un bouton "Profil" de redirection vers la page de profil utilisateur.
        3. Un bouton "Compte" de redirection vers la gestion de votre compte.

Nous pouvons y voir les personnes déjà inscrites et les suivre ou non au besoin.

Nous pouvons également poster des tweets, les visualiser et les supprimer.

//Screen
![docs/Welcome.jpg](docs/Welcome.jpg)

### Page Compte

La page de gestion du compte est disponible dans le menu de navigation comme expliquer précédemment dans la page d'accueil.

-   Vous y trouverez vos informations de compte avec possibilité de modifier à votre guise, votre avatar, nom, pseudo (tant qu'il reste unique), adresse e-mail, mot de passe.
    -   Lors d'une modification un message vous averti de la prise en compte de l'action.
-   Vous pourrez également si vous le souhaitez, supprimer complétement votre compte grâce à la rubrique de "Suppresion définitive de compte" situé en dessous de la gestion du compte.
    **_`Attention cette action est irréversible !`_**
    -   Une fois l'action effectué, vous êtes alors redirigé sur la page de bienvenue de l'application, avec un message vous confirmant la suppression de votre compte.

### Page Profil

La page de profil est disponible dans le menu de navigation comme expliqué précédemment dans la page d'accueil.
Sur celle-ci vous trouverez vos informations de profil :

1. Vos tweets,
2. Follower = ceux qui me suive
3. Following = ceux que moi je suis

En cliquant sur le nom d'un utilisateur, vous avez la possibilité de voir son profil.

//Screen
![docs/Welcome.jpg](docs/Welcome.jpg)

## Guide Technique

### Création du projet

#### - En invite de commande

1. Création du projet avec ou sans authentification (--auth)
   `laravel new nom_du_projet --auth`
2. Intégration complète de Bootstrap au projet sans lien CDN
    1. Installation du composant Bootstrap
       `composer require laravel/ui --dev`
    2. Intégration du composants dans le projet
       `php artisan ui bootstrap --auth`
    3. Mise à jour des fichiers crée avec l'intégration des class de Bootstrap
       `npm install && npm run dev`

Le projet doit maintenant être crée avec Bootstrap intégrer !!
Vérifier l'intégration de Bootstrap en lançant le serveur :
`php artisan serve`
Le terminal vous renvoie l'url et le port sur lequel se lance votre projet
ex par défault: http://127.0.0.1:8000

#### - Intégration Base de Données

3. Créer une BDD vide dans phpMyAdmin (MAMP ou autres)
   Lui donner le nom du projet exemple "laravel-twitter"

4. Modifier le ".env" du projet en conséquences

    1. Faire correspondre les données suivantes entre MySQL et votre projet

    ```
    DB_CONNECTION=mysql
    DB_HOST=localhost;
    DB_PORT=8889
    DB_DATABASE=laravel-twitter
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

    2. Modifier la ligne suivante pour les utilisateurs de mamps
       `DB_HOST=localhost;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock`

Votre projet dois désormais être connecter à la base de données, vous pourrez le constatez une fois que vous aurez effectué des migrations dans votre projet.

### Modification du système d'authentification de base de LARAVEL

#### 1. Modification de la migration

La migration se situe dans le dossier "database" puis "migrations"

-   Nom de la migration : année_mois_jour_000000_create_users_table.php
-   État par défault :

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

-   Ajout des données à la migration
    Le Schema de la function up() correspond aux attributs de la table "Users" de la BDD.
    Il suffit donc de lui ajouter nos nouveaux attribut, ici nous avons besoin d'un avatar, ainsi qu'un pseudonyme pour l'utlisateur.

    1. L'avatar peut être nulle car non obligatoire à la création d'un compte
       `$table->string('avatar')->nullable();`

    2. Le pseudonyme lui doit être unique car il ne peut exister 2 utilisateurs avec le même pseudonyme sous peine de conflit.
       `$table->string('pseudo')->unique();`

    Pour que nos modifications prennent effet en BDD, il faut lancer la migration.

#### 2. Migration de la table des "Users"

-   Lancer la migration dans la BDD
    `php artisan migrate`

    Si dans votre BDD, les attributs "avatar" et "pseudo" ont été ajouté cela signifie que votre BDD est bien configuré avec votre projet.
    Sinon un message d'erreur serait apparu.

<hr>
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## À propos de Laravel

Laravel est un framework d'application web avec une syntaxe expressive et élégante. Nous croyons que le développement doit être une expérience agréable et créative pour être vraiment épanouissant. Laravel simplifie le développement en facilitant les tâches courantes utilisées dans de nombreux projets Web, tels que :

-   [Moteur de routage simple et rapide](https://laravel.com/docs/routing).
-   [Conteneur d'injection de dépendance puissant](https://laravel.com/docs/container).
-   Plusieurs back-ends pour le stockage des [session](https://laravel.com/docs/session) et du [cache](https://laravel.com/docs/cache) storage.
-   [Base de données ORM](https://laravel.com/docs/eloquent), Expressive, intuitive.
-   [Migrations de schéma indépendantes de la base de données](https://laravel.com/docs/migrations).
-   [Traitement robuste des tâches en arrière-plan](https://laravel.com/docs/queues).
-   [Diffusion d'événements en temps réel](https://laravel.com/docs/broadcasting).

Laravel est accessible, puissant et fournit les outils requis pour les grandes applications robustes
