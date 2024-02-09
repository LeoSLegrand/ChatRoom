<?php
session_start();

// Function to check if an image exists for a message
function displayImage($image)
{
    if ($image) {
        echo "<img src='$image' alt='Uploaded Image' style='max-width: 100%;'>";
    }
}

// Function to convert URLs in the message text to clickable hyperlinks
function convertLinks($message)
{
    // Regular expression to match URLs
    $pattern = '/(https?:\/\/\S+)/';

    // Replace URLs with clickable hyperlinks
    $message = preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $message);

    return $message;
}

// If the user is connected
if (isset($_SESSION['user'])) {
    // Connect to the database
    include "connexion_bdd.php";

    // Query to display messages
    $req = mysqli_query($con, "SELECT * FROM messages ORDER BY id_m");

    if (mysqli_num_rows($req) == 0) {
        // If there are no messages yet
        echo "Messagerie vide";
    } else {
        // If there are messages

        while ($row = mysqli_fetch_assoc($req)) {
            // Retrieve formatting options
            $textColor = htmlspecialchars($row['text_color']);
            $bold = $row['is_bold'] == 1 ? 'font-weight: bold;' : '';
            $italics = $row['is_italics'] == 1 ? 'font-style: italic;' : '';
            $image = htmlspecialchars($row['image']);
            $msg = htmlspecialchars($row['msg']);

            // Create the style based on formatting options
            $style = '';
            if ($textColor) {
                $style .= "color: $textColor;";
            }
            if ($bold) {
                $style .= $bold;
            }
            if ($italics) {
                $style .= $italics;
            }

            // Convert URLs to clickable hyperlinks
            $msg = convertLinks($msg);

            // Display the message
            ?>
            <div class="message" style="<?= $style ?>">
                <span><?= htmlspecialchars($row['email']) ?></span>
                <?php displayImage($image); ?>
                <p><?= $msg ?> </p>
                <p class="date"><?= $row['date'] ?></p>
                <?php
                // Check if the logged-in user is an admin
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                    // Display delete button for admin users
                    ?>
                    <form action="deleteMessage.php" method="post">
                        <input type="hidden" name="message_id" value="<?= $row['id_m'] ?>">
                        <input type="submit" value="Delete">
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