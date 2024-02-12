<?php 
// Configuration de la base de données
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "ChatRoom";

// Établir la connexion à la base de données
$con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// Vérifier si la connexion a réussi
if (!$con) {
    // Enregistrer un message d'erreur détaillé
    error_log("Échec de la connexion à la base de données : " . mysqli_connect_error());

    // Afficher un message d'erreur générique aux utilisateurs
    die("Erreur de connexion à la base de données.");
}

// Définir l'encodage des caractères pour la connexion à la base de données à l'aide d'une instruction préparée
$stmt = mysqli_prepare($con, "SET NAMES UTF8");
mysqli_stmt_execute($stmt);
?>
