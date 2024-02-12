<?php
session_start();

// Vérifie si l'utilisateur est connecté et possède des privilèges d'administrateur
if (!isset($_SESSION['user']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    // Redirige vers la page de connexion ou affiche un message d'erreur
    header("Location: login.php"); // Redirige vers la page de connexion
    exit(); // Arrête l'exécution ultérieure
}

// Vérifie si l'identifiant du message est fourni via une requête POST
if (isset($_POST['message_id'])) {
    // Connexion à la base de données
    include "connexion_bdd.php";

    // Assainit l'identifiant du message
    $message_id = mysqli_real_escape_string($con, $_POST['message_id']);

    // Prépare une requête de suppression
    $delete_query = "DELETE FROM messages WHERE id_m = ?";

    // Prépare la requête
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) {
        // Lie les paramètres
        mysqli_stmt_bind_param($stmt, "i", $message_id);

        // Exécute la requête
        if (mysqli_stmt_execute($stmt)) {
            // Message supprimé avec succès
            // Redirige vers la page de chat ou affiche un message de succès
            header("Location: chat.php");
            exit(); // Arrête l'exécution ultérieure
        }
    }

    // Une erreur s'est produite lors de la suppression du message
    // Redirige vers la page de chat ou affiche un message d'erreur
    header("Location: chat.php");
    exit(); // Arrête l'exécution ultérieure
} else {
    // L'identifiant du message n'est pas fourni
    // Redirige vers la page de chat ou affiche un message d'erreur
    header("Location: chat.php");
    exit(); // Arrête l'exécution ultérieure
}
?>
