<?php
// Start the session
session_start();

if (!isset($_SESSION['user'])) {
    // If the user is not connected, redirect to the login page
    header("location:index.php");
}

$user = $_SESSION['user']; // User's email
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$user?> | CHAT</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="chat">
        <div class="button-email">
            <span> <?=$user?> </span>
            <?php
            // Check if the user is an admin
            if ($_SESSION['isAdmin']) {
                // If user is an admin, display the "Gérer les comptes" button
                ?>
                <a href="manageAccount.php" class="manage_account_btn">Gérer les comptes</a>
                <?php
            }
            ?>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        <!-- Messages -->
        <div class="messages_box"> Chargement ...</div>
        <!-- End of messages -->

        <?php
        // Sending messages
        if (isset($_POST['send'])) {
            // Retrieve the message
            $message = $_POST['message'];
            // Retrieve formatting options
            $textColor = isset($_POST['text_color']) ? $_POST['text_color'] : '';
            $bold = isset($_POST['bold']) ? 1 : 0;
            $italics = isset($_POST['italics']) ? 1 : 0;

            // Handling image upload
            $image = '';

            // Check if the directory exists, if not, create it
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Check if an image was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $targetFile = $uploadDir . basename($_FILES['image']['name']);

                // Move the uploaded image to the target directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $image = $targetFile;
                } else {
                    // Handle the case where the image upload fails
                    echo "Error uploading image.";
                }
            }

            // Connect to the database
            include_once "connexion_bdd.php";

            // Check if the field is not empty
            if (isset($message) && $message != "") {
                // Insert the message into the database with formatting options
                $stmt = mysqli_prepare($con, "INSERT INTO messages (email, msg, date, text_color, is_bold, is_italics, image) VALUES (?, ?, NOW(), ?, ?, ?, ?)");

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $user, $message, $textColor, $bold, $italics, $image);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    // Handle the case where prepare fails
                    echo "Error in preparing the SQL statement.";
                }

                // Refresh the page
                header('location:chat.php');
            } else {
                // If the message is empty, refresh the page
                header('location:chat.php');
            }
        }
        ?>

        <form action="" class="send_message" method="POST" enctype="multipart/form-data">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>

            <!-- Formatting options -->
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
                <!-- Image upload field -->
                <label for="image">Image :</label>
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" value="Envoyer" name="send">
        </form>
    </div>

    <script>
        // Automatically update the chat using AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "messages.php", true); // Retrieve the message page
            xhttp.send()
        }, 500) // Update the chat every 500 ms
    </script>
</body>

</html>
