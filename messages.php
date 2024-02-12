<?php
session_start();

// Fonction pour vérifier si une image existe pour un message
function afficherImage($image)
{
    if ($image) {
        echo "<img src='" . htmlspecialchars($image) . "' alt='Image téléchargée' style='max-width: 100%;'>";
    }
}

// Fonction pour convertir les URL dans le texte du message en liens cliquables
function convertirLiens($message)
{
    // Expression régulière pour rechercher les URL
    $pattern = '/(https?:\/\/\S+)/';

    // Remplacer les URL par des liens cliquables
    $message = preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $message);

    return $message;
}

// Si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Connexion à la base de données
    include "connexion_bdd.php";

    // Requête pour afficher les messages
    $stmt = mysqli_prepare($con, "SELECT * FROM messages ORDER BY id_m");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        // S'il n'y a pas encore de messages
        echo "Messagerie vide";
    } else {
        // S'il y a des messages

        while ($row = mysqli_fetch_assoc($result)) {
            // Obtenir les options de mise en forme
            $texteCouleur = $row['text_color'] ? htmlspecialchars($row['text_color']) : '';
            $gras = $row['is_bold'] == 1 ? 'font-weight: bold;' : '';
            $italique = $row['is_italics'] == 1 ? 'font-style: italic;' : '';
            $image = $row['image'] ? htmlspecialchars($row['image']) : '';
            $msg = $row['msg'] ? htmlspecialchars($row['msg']) : '';

            // Créer le style en fonction des options de mise en forme
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

            // Convertir les URL dans le message en liens cliquables
            $msg = convertirLiens($msg);

            // Afficher le message
            ?>
            <div class="message" style="<?= htmlspecialchars($style) ?>">
                <span><?= $row['email'] ? htmlspecialchars($row['email']) : '' ?></span>
                <?php afficherImage($image); ?>
                <p><?= $msg ?> </p>
                <p class="date"><?= htmlspecialchars($row['date']) ?></p>
                <?php
                // Vérifier si l'utilisateur connecté est un administrateur
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                    // Afficher le bouton de suppression pour les utilisateurs administrateurs
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
