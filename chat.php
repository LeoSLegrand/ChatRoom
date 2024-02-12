<?php
// Démarrer la session
session_start();

if (!isset($_SESSION['user'])) {
    // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
    header("location:index.php");
    exit(); // Arrêter l'exécution ultérieure
}

$user = htmlspecialchars($_SESSION['user']); // Nettoyer l'email de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $user ?> | CHAT</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="chat">
        <div class="button-email">
            <span> <?= $user ?> </span>
            <?php
            // Vérifier si l'utilisateur est un administrateur
            if ($_SESSION['isAdmin']) {
                // Si l'utilisateur est un administrateur, afficher le bouton "Gérer les comptes"
                ?>
                <a href="manageAccount.php" class="manage_account_btn">Gérer les comptes</a>
                <?php
            }
            ?>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        <!-- Messages -->
        <div class="messages_box"> Chargement ...</div>
        <!-- Fin des messages -->

        <?php
        // Envoi des messages
        if (isset($_POST['send'])) {
            // Récupérer le message et le nettoyer
            $message = htmlspecialchars($_POST['message']);

            // Récupérer les options de formatage
            $textColor = isset($_POST['text_color']) ? htmlspecialchars($_POST['text_color']) : '';
            $bold = isset($_POST['bold']) ? 1 : 0;
            $italics = isset($_POST['italics']) ? 1 : 0;


            // Vérifier si le répertoire existe, sinon le créer
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Vérifier si une image a été téléchargée et valider le type de fichier
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $targetFile = $uploadDir . basename($_FILES['image']['name']);

                // Obtenir l'extension du fichier
                $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Extensions de fichiers image autorisées
                $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

                // Vérifier si l'extension du fichier est dans la liste autorisée
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Déplacer l'image téléchargée vers le répertoire cible
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $image = $targetFile;
                    } else {
                        // Gérer le cas où le téléchargement de l'image échoue
                        echo "Erreur lors du téléchargement de l'image.";
                    }
                } else {
                    // Si l'extension du fichier n'est pas autorisée, afficher un message d'erreur
                    echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                }
            }


            // Connexion à la base de données
            include_once "connexion_bdd.php";

            // Vérifier si le champ n'est pas vide
            if (!empty($message)) {
                // Insérer le message dans la base de données avec les options de formatage en utilisant des instructions préparées
                $stmt = mysqli_prepare($con, "INSERT INTO messages (email, msg, date, text_color, is_bold, is_italics, image) VALUES (?, ?, NOW(), ?, ?, ?, ?)");

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $user, $message, $textColor, $bold, $italics, $image);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    // Gérer le cas où la préparation échoue
                    echo "Erreur lors de la préparation de l'instruction SQL.";
                }

                // Rafraîchir la page
                header('location:chat.php');
                exit(); // Arrêter l'exécution ultérieure
            } else {
                // Si le message est vide, rafraîchir la page
                header('location:chat.php');
                exit(); // Arrêter l'exécution ultérieure
            }
        }
        ?>

        <form action="" class="send_message" method="POST" enctype="multipart/form-data">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>

            <!-- Options de formatage -->
            <label for="text_color">Couleur du texte :</label>
            <input type="color" id="text_color" name="text_color">

            <div>
                <label for="bold">Gras :</label>
                <input type="checkbox" id="bold" name="bold">
            </div>

            <div>
                <label for="italics">Italique :</label>
                <input type="checkbox" id="italics" name="italics">
            </div>

            <div>
                <!-- Champ de téléchargement d'image -->
                <label for="image">Image :</label>
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" value="Envoyer" name="send">
        </form>
    </div>

    <script>
        // Mettre à jour automatiquement le chat en utilisant AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "messages.php", true); // Récupérer la page de message
            xhttp.send()
        }, 500) // Mettre à jour le chat toutes les 500 ms
    </script>
</body>

</html>
