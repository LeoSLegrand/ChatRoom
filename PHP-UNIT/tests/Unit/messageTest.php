
 <?php
 
 use PHPUnit\Framework\TestCase;

 class messageTest extends TestCase
 {
     // Mettez à jour avec les informations de votre base de données de test
     private $host = "localhost";
     private $username = "root";
     private $password = "";
     private $database = "chatroom";
 
     public function testSendMessage()
     {
         // Inclure la connexion à la base de données
         include "../../../connexion_bdd.php";

         // Simuler la session pour un utilisateur connecté
         session_start();
         $_SESSION['user'] = "Hello@gmail.com";

          // Tentez de vous connecter à la base de données
          $con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
 
         // Simuler l'envoi d'un message
         $message = "Apparament mais les vieux compte marche plus sad";
 
         // Inclure le fichier messages.php
         include_once "../../../messages.php";
 
         // Récupérer le dernier message dans la base de données
         $result = mysqli_query($con, "SELECT * FROM messages ORDER BY id_m DESC LIMIT 1");
         $lastMessage = mysqli_fetch_assoc($result);
 
         // Assurer que le message a été inséré dans la base de données avec le bon contenu et l'utilisateur correct
         $this->assertEquals($_SESSION['user'], $lastMessage['email']);
         $this->assertEquals($message, $lastMessage['msg']);
 
         // Nettoyer : déconnexion de l'utilisateur
         session_destroy();
     }

 }
 ?>
