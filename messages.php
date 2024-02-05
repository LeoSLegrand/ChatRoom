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
            $textColor = $row['text_color'];
            $bold = $row['is_bold'] == 1 ? 'font-weight: bold;' : '';
            $italics = $row['is_italics'] == 1 ? 'font-style: italic;' : '';
            $image = $row['image'];
            $msg = $row['msg'];

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
            if ($row['email'] == $_SESSION['user']) {
                // If you sent the message
                ?>
                <div class="message your_message" style="<?= $style ?>">
                    <span>Vous</span>
                    <?php displayImage($image); ?>
                    <p><?= $msg ?></p>
                    <p class="date"><?= $row['date'] ?></p>
                </div>
                <?php
            } else {
                // If you are not the author of the message
                ?>
                <div class="message others_message" style="<?= $style ?>">
                    <span><?= $row['email'] ?></span>
                    <?php displayImage($image); ?>
                    <p><?= $msg ?> </p>
                    <p class="date"><?= $row['date'] ?></p>
                </div>
                <?php
            }
        }
    }
}
?>
