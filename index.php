<?php 
// Démarre la session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php 
    if(isset($_POST['button_con'])){
        include "connexion_bdd.php";
        extract($_POST);

        // Utilise une commande préparée pour éviter les injections SQL
        if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != ""){
            $stmt = mysqli_prepare($con, "SELECT * FROM utilisateurs WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $req = mysqli_stmt_get_result($stmt);

            // Vérifie si la requête a réussi
            if($req){
                // Vérifie s'il y a bien des rows dans la table où on requête
                if(mysqli_num_rows($req) > 0){
                    $user = mysqli_fetch_assoc($req);

                    // Utilise password_verify pour vérifier si le mot de passe entré correspond rapport à celui qui est hashé dans la BDD
                    if(password_verify($mdp1, $user['mdp'])){
                        // Régénère l'ID de session pour éviter les attaques de fixation de session
                        session_regenerate_id(true);

                        $_SESSION['user'] = htmlspecialchars($email); // Sanitize user input
                        $_SESSION['isAdmin'] = $user['IsAdmin']; // Set the isAdmin flag in the session
                        header("location:chat.php");
                        unset($_SESSION['message']);
                    } else {
                        $error = "Email ou Mot de passe incorrect(s) !";
                    }
                } else {
                    $error = "Email ou Mot de passe incorrect(s) !";
                }
            } else {
                // Gère l'échec de la requête
                $error = "Erreur lors de l'exécution de la requête: " . mysqli_error($con);
            }
        } else {
            $error = "Veuillez remplir tous les champs !";
        }
    }
    ?>

    <form action=""  method="POST" class="form_connexion_inscription">
        <h1>CONNEXION</h1>
        <?php
        // Affiche le message qui dit qu'un compte a été créé
        if(isset($_SESSION['message'])){
            echo htmlspecialchars($_SESSION['message']); // Sanitize user input
        }
        ?>

        <p class="message_error">
            <?php 
            // Affiche l'erreur
            if(isset($error)){
                echo htmlspecialchars($error); // Sanitize user input
            }
            ?>
        </p>

        <label>Adresse Mail</label>
        <input type="email" name="email">
        <label>Mots de passe</label>
        <input type="password" name="mdp1">
        <input type="submit" value="Connexion" name="button_con">
        <p class="link">Vous n'avez pas de compte ? <br><a href="inscription.php">Créer un compte</a></p>
    </form>
</body>
</html>
