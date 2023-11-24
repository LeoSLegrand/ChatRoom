
 <?php
 
 use PHPUnit\Framework\TestCase;

 class LoginTest extends TestCase
 {
     // Mettez à jour avec les informations de votre base de données de test
     private $host = "localhost";
     private $username = "root";
     private $password = "";
     private $database = "chatroom";
 
     public function testConnection()
     {
         // Tentez de vous connecter à la base de données
         $con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
 
         // Vérifiez si la connexion a réussi
         $this->assertTrue($con !== false);
 
         // Assurez-vous que les caractères UTF-8 sont gérés
         $req = mysqli_query($con, "SET NAMES UTF8");
         $this->assertTrue($req !== false);
 
         // Fermez la connexion
         mysqli_close($con);
     }

 
 }
 ?>
