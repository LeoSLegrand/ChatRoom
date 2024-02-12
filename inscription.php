<?php 
// Démarrer la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if(isset($_POST['button_inscription'])){
        // Si le formulaire est envoyé, connectez-vous à la base de données
        include "connexion_bdd.php";

        // Extraire les informations du formulaire
        extract($_POST);

        // Vérifiez si les champs sont vides
        if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "" && isset($mdp2) && $mdp2 != ""){

            // Vérifie que les mots de passe sont conformes aux critères de sécurité
            if(strlen($mdp1) < 8) {
                $error = "Le mot de passe doit contenir au moins 8 caractères.";
            } elseif (!preg_match("#[0-9]+#", $mdp1)) {
                $error = "Le mot de passe doit contenir au moins un chiffre.";
            } elseif (!preg_match("#[^\w]+#", $mdp1)) {
                $error = "Le mot de passe doit contenir au moins un caractère spécial.";
            } elseif ($mdp2 != $mdp1) {
                $error = "Les mots de passe ne correspondent pas.";
            } else {
                // Hasher le mot de passe
                $hashedPassword = password_hash($mdp1, PASSWORD_DEFAULT);

                // Vérifiez si l'email existe déjà
                $stmt = mysqli_prepare($con, "SELECT * FROM utilisateurs WHERE email = ?");
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 0){
                    // Si l'email n'existe pas déjà, créez le compte
                    $stmt = mysqli_prepare($con, "INSERT INTO utilisateurs VALUES (NULL, ?, ?, 0)");
                    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
                    $success = mysqli_stmt_execute($stmt);

                    if($success){
                        // Si le compte a été créé, définissez une variable pour afficher un message dans la page de connexion
                        $_SESSION['message'] = "Votre compte a été créé avec succès !";
                        // Redirection vers la page de connexion
                        header("Location:index.php") ;
                        exit();
                    } else {
                        // Si l'inscription échoue
                        $error = "Inscription échouée !";
                    }
                } else {
                    // Si l'email existe déjà
                    $error = "Cet email existe déjà !";
                }
            }
        } else {
            // Si tous les champs ne sont pas remplis
            $error = "Veuillez remplir tous les champs !" ;
        }
    }
    ?>

    <form action="" method="POST" class="form_connexion_inscription">
        <h1>INSCRIPTION</h1>
        <p class="message_error" id="error_message">
            <?php 
            // Affichage des erreurs
            if(isset($error)){
                echo htmlspecialchars($error) ;
            }
            ?>
        </p>
        <p class="message_error" id="email_error_message"></p> <!-- Message d'erreur pour l'e-mail -->

        <label>Adresse Mail</label>
        <input type="email" name="email">
        <label>Mot de passe</label>
        <input type="password" name="mdp1" class="mdp1">
        <label>Confirmer le mot de passe</label>
        <input type="password" name="mdp2" class="mdp2">
        <input type="submit" value="Inscription" name="button_inscription">
        <p class="link">Vous avez un compte ? <br><a href="index.php">Connectez-vous</a></p>
    </form>

    <script>
        const emailInput = document.querySelector('input[name="email"]');
        const emailErrorMessageBox = document.getElementById('email_error_message');

        emailInput.addEventListener('input', () => {
            const email = emailInput.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let errorMessage = '';

            if (!emailRegex.test(email)) {
                errorMessage = "L'email n'est pas valide.";
            }

            emailErrorMessageBox.textContent = errorMessage;
        });

        const mdp1Input = document.querySelector('.mdp1');
        const errorMessageBox = document.getElementById('error_message');

        mdp1Input.addEventListener('input', () => {
            const password = mdp1Input.value;
            let errorMessage = '';

            if (password.length < 8) {
                errorMessage = 'Le mot de passe doit contenir au moins 8 caractères.';
            } else if (!/\d/.test(password)) {
                errorMessage = 'Le mot de passe doit contenir au moins un chiffre.';
            } else if (!/\W/.test(password)) {
                errorMessage = 'Le mot de passe doit contenir au moins un caractère spécial.';
            }

            errorMessageBox.textContent = errorMessage;
        });
    </script>
</body>
</html>
