<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include_once "connexion_bdd.php";

// Vérifier si l'utilisateur est connecté et a des privilèges d'administrateur
if (!isset($_SESSION['user']) || !$_SESSION['isAdmin']) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header("Location: login.php"); // Redirection vers la page de connexion
    exit(); // Arrêter l'exécution ultérieure
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la liste des comptes d'utilisateurs depuis la base de données à nouveau pour s'assurer qu'elle est à jour
    $query = "SELECT id_u, email, IsAdmin FROM utilisateurs";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Parcourir chaque compte utilisateur
    while ($row = mysqli_fetch_assoc($result)) {
        // Mettre à jour le statut IsAdmin de l'utilisateur à 1
        // Vérifier si la case à cocher pour cet utilisateur est cochée
        if (isset($_POST['admin_' . $row['id_u']])) {
            // Mettre à jour le statut IsAdmin de l'utilisateur à 1
            $updateQuery = "UPDATE utilisateurs SET IsAdmin = 1 WHERE id_u = ?";
            $stmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmt, "i", $row['id_u']);
            mysqli_stmt_execute($stmt);
        } else {
            // Mettre à jour le statut IsAdmin de l'utilisateur à 0
            $updateQuery = "UPDATE utilisateurs SET IsAdmin = 0 WHERE id_u = ?";
            $stmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmt, "i", $row['id_u']);
            mysqli_stmt_execute($stmt);
        }
    }
    // Fournir un retour d'information à l'administrateur
    $success_message = "Privilèges d'administrateur mis à jour avec succès.";
}

// Récupérer la liste des comptes d'utilisateurs depuis la base de données
$query = "SELECT id_u, email, IsAdmin FROM utilisateurs";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fermer la connexion à la base de données
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les comptes</title>
    <link rel="stylesheet" href="manageAccount.css">
</head>

<body>
    <div class="container">
        <h1>Gérer les comptes d'utilisateurs</h1>

        <?php if (isset($success_message)) : ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <?php
            if ($result) {
                // Afficher la liste des comptes d'utilisateurs avec des cases à cocher
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<input type='checkbox' name='admin_" . htmlspecialchars($row['id_u']) . "' value='1'";
                    // Cocher la case si l'utilisateur est un administrateur
                    if ($row['IsAdmin']) {
                        echo " checked";
                    }
                    echo ">" . htmlspecialchars($row['email']) . "<br>";
                }
            } else {
                echo "Erreur : Impossible de récupérer les comptes d'utilisateurs.";
            }
            ?>
            <input type="submit" value="Enregistrer">
        </form>

        <div class="back-button">
            <a href="manageAccount.php">Recharger</a>
            <a href="chat.php">Retour au chat</a>
        </div>
    </div>
</body>

</html>
