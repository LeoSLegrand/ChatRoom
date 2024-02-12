<?php 
// Démarre la session
session_start();

// Destruction de la session
session_destroy();

// Régénère l'identifiant de session pour prévenir les attaques de fixation de session
session_regenerate_id(true);

// Redirection vers la page de connexion
header("Location: index.php");
exit(); // Arrêter l'exécution ultérieure pour assurer la redirection
?>
