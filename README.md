1. **Lancer WampServer:**
   - Assurez vous que WampServer est installé sur votre système.
   - Lancez WampServer en exécutant l'application.

2. **Vérifier l'état de WampServer:**
   - Assurez vous que l'icône de WampServer dans la barre des tâches est verte, ce qui indique que le serveur Apache et MySQL sont en cours d'exécution.

3. **Accéder au répertoire du projet:**
   - Ouvrez l'explorateur de fichiers et naviguez jusqu'au répertoire où vous avez stocké votre projet de chatroom. Il s'agit de wamp64/www/chatroom. Le projet doit être inséré ici, vérifiez le.

4. **Accéder à la chatroom dans le navigateur:**
   - Ouvrez votre navigateur web.
   - Dans la barre d'adresse, tapez http://localhost/ChatRoom.

En suivant ces étapes, vous devriez être en mesure de lancer votre chatroom localement via WampServer en accédant à **http://localhost/ChatRoom** dans votre navigateur. 

Désormais, nous allons voir la configuration de la base de données pour permettre à cette application d'atteindre tout son potentiel et toutes ses capacités.

1. **Lancer PhpMyAdmin:**
   - Connectez vous avec l'identifiant: root , et le mot de passe: *vide*

2. **Utiliser le script de la base de donnée:**
   - Utiliser le .sql, dans importer sur PhpMyAdmin



### Inscription pour accéder au chat room

Pour accéder au chat room, veuillez suivre les étapes suivantes :

1. **Inscription :**
   - Sur la page d'accueil, cliquez sur le bouton "S'inscrire".
   - Remplissez le formulaire d'inscription avec les informations requises : nom d'utilisateur, adresse e-mail et mot de passe.
   - Assurez-vous que votre mot de passe respecte les critères de sécurité suivants :
     - Au moins 8 caractères de longueur.
     - Doit contenir au moins un chiffre.
     - Doit contenir au moins un caractère spécial.

2. **Connexion en tant qu'utilisateur :**
   - Après avoir créé votre compte, connectez-vous en utilisant vos identifiants.

3. **Accès en tant qu'administrateur :**
   - Pour accéder en tant qu'administrateur, utilisez les informations suivantes :
     - Adresse e-mail : admin@man
     - Mot de passe : a
   - Une fois connecté en tant qu'administrateur, toutes les fonctionnalités seront disponibles.

Note : Les comptes d'utilisateur créés auront accès à toutes les fonctionnalités du chat room, à l'exception de la suppression et de la gestion des rôles.
Pour modifier cela il vous faudra modifier la valeur booleen directement dans la bdd.




