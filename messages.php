<?php
session_start();

// Function to verify if an image exists for a message
function afficherImage($image)
{
    if ($image) {
        echo "<img src='" . htmlspecialchars($image) . "' alt='Image téléchargée' style='max-width: 100%;'>";
    }
}

// Function to convert URLs in message text to clickable links
function convertirLiens($message)
{
    // Regular expression to match URLs
    $pattern = '/(https?:\/\/\S+)/';

    // Replace URLs with clickable links
    $message = preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $message);

    return $message;
}

// If the user is logged in
if (isset($_SESSION['user'])) {
    // Connect to the database
    include "connexion_bdd.php";

    // Query to display messages
    $stmt = mysqli_prepare($con, "SELECT * FROM messages ORDER BY id_m");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        // If there are no messages yet
        echo "Messagerie vide";
    } else {
        // If there are messages

        while ($row = mysqli_fetch_assoc($result)) {
            // Get formatting options
            $texteCouleur = $row['text_color'] ? htmlspecialchars($row['text_color']) : '';
            $gras = $row['is_bold'] == 1 ? 'font-weight: bold;' : '';
            $italique = $row['is_italics'] == 1 ? 'font-style: italic;' : '';
            $image = $row['image'] ? htmlspecialchars($row['image']) : '';
            $msg = $row['msg'] ? htmlspecialchars($row['msg']) : '';

            // Create style based on formatting options
            $style = '';
            if ($texteCouleur) {
                $style .= "color: $texteCouleur;";
            }
            if ($gras) {
                $style .= $gras;
            }
            if ($italique) {
                $style .= $italique;
            }

            // Convert URLs in message to clickable links
            $msg = convertirLiens($msg);

            // Display the message
            ?>
            <div class="message" style="<?= htmlspecialchars($style) ?>">
                <span><?= $row['email'] ? htmlspecialchars($row['email']) : '' ?></span>
                <?php afficherImage($image); ?>
                <p><?= $msg ?> </p>
                <p class="date"><?= htmlspecialchars($row['date']) ?></p>
                <?php
                // Check if the logged-in user is an administrator
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                    // Display the delete button for administrator users
                    ?>
                    <form action="deleteMessage.php" method="post">
                        <input type="hidden" name="message_id" value="<?= htmlspecialchars($row['id_m']) ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}
?>
