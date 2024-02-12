## Phase de préparation

1. **Lancer WampServer:**
   - Assurez vous que WampServer est installé sur votre système.
   - Lancez WampServer en exécutant l'application.

2. **Vérifier l'état de WampServer:**
   - Assurez vous que l'icône de WampServer dans la barre des tâches est verte, ce qui indique que le serveur Apache et MySQL sont en cours d'exécution.

3. **Accéder au répertoire du projet:**
   - Ouvrez l'explorateur de fichiers et naviguez jusqu'au répertoire wamp64/www/. Créer un dossier "Chatroom" et insérer les fichier que vous avez récupérer sur github dans le nouveau dossier "Chatroom".

4. **Accéder à la chatroom dans le navigateur:**
   - Ouvrez votre navigateur web.
   - Dans la barre d'adresse, aller à http://localhost/Chatroom.

<br>

## Configuration de la base de données

1. **Lancer PhpMyAdmin:**
   - Dans votre navigateur aller à : http://localhost/phpmyadmin/.
   - Connectez vous avec l'identifiant: root , et le mot de passe: *vide*

2. **Utiliser le script de la base de donnée:**
   - Récupérer le fichier "chatroom.sql" présent dans le github.
   - Importer le dans PhpMyAdmin pour créer la base de donnée utilisé par l'application.

<br>

## Inscription pour accéder au chat

1. **Création de compte :**
   - Sur la page d'accueil (http://localhost/Chatroom/), cliquez sur le bouton "Créer un compte".
   - Remplissez le formulaire d'inscription avec les informations requises : adresse e-mail et mot de passe.
   - Assurez-vous que votre mot de passe respecte les critères de sécurité suivants :
     - Au moins 8 caractères de longueur.
     - Doit contenir au moins un chiffre.
     - Doit contenir au moins un caractère spécial.

2. **Connexion en tant qu'utilisateur :**
   - Après avoir créé votre compte, vous êtes redirigez vers la page principal. 
   - Connectez-vous en utilisant vos identifiants, vous avez désormais accès au chat en tant que compte "utilisateur".

3. **Accès administrateur :**
   - Les comptes utilisateur ne peuvent recevoir le role admin que de deux manière :
     - Modifier la valeur "isAdmin" directement dans la table "utilisateurs" de la  base de donnée.
     - Connecter vous avec un compte admin, accéder au chat puis cliquer sur "Gérer les comptes", enfin cocher la case à coté du compte auquel vous souhaiter donner le rôle admin et "Enregistrer".

<br>

Afin de vous permettre de tester l'application, un compte admin est déjà créer de base. Ses identifiant sont : 
   - Adresse Mail : admin@man
   - Mots de passe : a