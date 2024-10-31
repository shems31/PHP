CV_PHP-TP
XAMPP a été choisi au détriment de Docker.

Projet Web CV/Portfolio
Contexte
Ce projet a été réalisé dans le cadre du cours de PHP. Il s'agit d'un site web CV/Portfolio permettant aux utilisateurs de créer, modifier et personnaliser leurs CV ainsi que de gérer leurs projets.

Fonctionnalités principales
CV
Un utilisateur connecté peut consulter et modifier ses informations de CV.
Personnalisation du style de la page CV pour chaque utilisateur.
Les utilisateurs peuvent choisir quel CV afficher ou télécharger le CV au format PDF.
Projets
Un utilisateur connecté peut ajouter des projets à son portfolio.
Un utilisateur peut également modifier et supprimer ses projets.
Les projets peuvent être marqués comme favoris et sont recherchables.
Pages du site
Page d'accueil : Une landing page statique qui présente le projet.
Page contact : Un formulaire pour envoyer un message via email.
Page CV modifiable : Un espace où l'utilisateur connecté peut consulter et modifier son CV.
Page projets : Une page listant les projets de l'utilisateur connecté.
Page login/logout : Authentification des utilisateurs.
Page profil : Un espace pour modifier ses informations personnelles.
Structure du projet
/pages : Regroupe les différentes pages du site (contact, profil, projets, etc.).
/php : Regroupe les fichiers PHP principaux pour l'authentification, la gestion des utilisateurs, l'envoi de formulaires, etc.
/includes : Contient les composants communs tels que l'en-tête, le pied de page, et les éléments du menu de navigation.
/css : Contient les fichiers de style CSS utilisés pour la mise en page.
Technologies utilisées
PHP : Côté serveur pour la gestion des formulaires, l'authentification et la gestion des utilisateurs.
MySQL : Pour la persistance des données (utilisateurs, projets, CV).
HTML/CSS : Pour la structure et le design des pages.
PHPMailer : Librairie utilisée pour envoyer des emails depuis la page de contact.
JavaScript/jQuery : Pour ajouter de l'interactivité aux pages.
Bootstrap : Framework CSS pour un design réactif
1. Clonez ce dépôt via GitHub :
   ```bash
   git clone https://github.com/shems31/PHP.gitgi
