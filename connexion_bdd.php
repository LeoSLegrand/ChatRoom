<?php 
    //Connexion à la base de données
    $con = mysqli_connect("localhost","root","","ChatRoom");
    //gérer les accents et autres caractères français
    $req= mysqli_query($con , "SET NAMES UTF8");
    if(!$con){
        //si la connexion échoue , afficher :
        echo "Connexion échouée";
    }


/*
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "ChatRoom");

// Gérer les accents et autres caractères français
$req = mysqli_query($con, "SET NAMES UTF8");

// Vérifier si la connexion a échoué
if (!$con) {
    // Si la connexion échoue, afficher un message d'erreur et arrêter l'exécution du script
    die("Connexion échouée : " . mysqli_connect_error());
}
?> */