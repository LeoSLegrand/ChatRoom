<?php
// Start the session
session_start();

// Include the database connection file
include_once "connexion_bdd.php";

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user']) || !$_SESSION['isAdmin']) {
    // Redirect to login page or display an error message
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the list of user accounts from the database again to ensure it's up to date
    $query = "SELECT id_u, email, IsAdmin FROM utilisateurs";
    $result = mysqli_query($con, $query);

    // Loop through each user account
    while ($row = mysqli_fetch_assoc($result)) {
        // Update the user's IsAdmin status to 1
        // Check if the checkbox for this user is checked
        if (isset($_POST['admin_' . $row['id_u']])) {
            // Update the user's IsAdmin status to 1
            $updateQuery = "UPDATE utilisateurs SET IsAdmin = 1 WHERE id_u = '" . $row['id_u'] . "'";
            mysqli_query($con, $updateQuery);
            $row['IsAdmin'] = 1; // Update the IsAdmin status in the current row
        } else {
            // Update the user's IsAdmin status to 0
            $updateQuery = "UPDATE utilisateurs SET IsAdmin = 0 WHERE id_u = '" . $row['id_u'] . "'";
            mysqli_query($con, $updateQuery);
            $row['IsAdmin'] = 0; // Update the IsAdmin status in the current row
        }
    }
    // Provide feedback to the admin
    $success_message = "Admin privileges updated successfully.";
}

// Retrieve the list of user accounts from the database
$query = "SELECT id_u, email, IsAdmin FROM utilisateurs";
$result = mysqli_query($con, $query);

// Close the database connection
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="manageAccount.css">
</head>

<body>
    <div class="container">
        <h1>Manage User Accounts</h1>

        <?php if (isset($success_message)) : ?>
            <div class="success-message">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <?php
            if ($result) {
                // Display the list of user accounts with checkboxes
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<input type='checkbox' name='admin_" . $row['id_u'] . "' value='1'";
                    // Check the checkbox if the user is an admin
                    if ($row['IsAdmin']) {
                        echo " checked";
                    }
                    echo ">" . $row['email'] . "<br>";
                }
            } else {
                echo "Error: Unable to fetch user accounts.";
            }
            ?>
            <input type="submit" value="Save">
        </form>

        <div class="back-button">
            <a href="manageAccount.php">Reload</a>
            <a href="chat.php">Back to Chat</a>
        </div>
    </div>
</body>

</html>
