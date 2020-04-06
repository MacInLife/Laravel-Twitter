## I - Guide Utilisateur

### A. Page de bienvenue

-   Modification de la page d'accueil basique de Laravel par une page d'accueil avec un design épuré correspondant à notre application.

    -   Bienvenue sur Twitter Laravel
    -   Un bouton d'inscription (S'inscrire)
    -   Un bouton d'identification (S'identifier)

![docs/Welcome.jpg](Welcome.jpg)

### B. Authentification

-   Modification du système d'authentification de Laravel (inscription, connexion) pour utiliser un nom (name) et un nom d'utilisateur ou pseudo (pseudo) avec ou sans avatar (avatar). Un avatar par défault sera utilisé à la création du compte utilisateur et le pseudo ainsi que l'adresse e-mail est unique.

    -   Ex: Avatar - John Do - @johnDo.
        ![docs/inscription.jpg](inscription.jpg)

        ![docs/login.jpg](login.jpg)

### C. Page d'accueil

A la création du compte ou à l'identification, nous arrivons sur la page d'accueil de l'application.

-   Un menu de navigation est accessible sur toutes les pages une fois la connexion effectuée avec quelques options :
    -   Le titre de l'application 'Twitter Laravel' ramenant sur la page de bienvenue.
    -   Votre nom ou pseudo permettant d'accéder à un sous-menu déroulant comportant les actions suivantes :
        1. Un bouton de "Se déconnecter" redirigeant l'utilisateur sur la page de bienvenue, en le déconnectant.
        2. Un bouton "Profil" de redirection vers la page de profil utilisateur.
        3. Un bouton "Compte" de redirection vers la gestion de votre compte.

Nous pouvons y voir les personnes déjà inscrites et les suivre ou non au besoin.

Nous pouvons également poster des tweets, les visualiser et les supprimer.

![docs/accueil.png](accueil.png)

### D. Page Compte

La page de gestion du compte est disponible dans le menu de navigation comme expliquer précédemment dans la page d'accueil.

-   Vous y trouverez vos informations de compte avec possibilité de modifier à votre guise, votre avatar, nom, pseudo (tant qu'il reste unique), adresse e-mail, mot de passe.
    -   Lors d'une modification un message vous averti de la prise en compte de l'action.
-   Vous pourrez également si vous le souhaitez, supprimer complétement votre compte grâce à la rubrique de "Suppresion définitive de compte" situé en dessous de la gestion du compte.
    **_`Attention cette action est irréversible !`_**
    -   Une fois l'action effectué, vous êtes alors redirigé sur la page de bienvenue de l'application, avec un message vous confirmant la suppression de votre compte.

![docs/compte.jpg](compte.jpg)

### E. Page Profil

La page de profil est disponible dans le menu de navigation comme expliqué précédemment dans la page d'accueil.
Sur celle-ci vous trouverez vos informations de profil :

1. Vos tweets,
2. Follower = ceux qui me suive
3. Following = ceux que moi je suis

En cliquant sur le nom d'un utilisateur, vous avez la possibilité de voir son profil.

![profil.png](profil.png)
