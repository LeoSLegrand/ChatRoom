<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    // Redirect to login page or display an error message
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further execution
}

// Check if the message ID is provided via POST request
if (isset($_POST['message_id'])) {
    // Connect to the database
    include "connexion_bdd.php";

    // Sanitize the message ID
    $message_id = mysqli_real_escape_string($con, $_POST['message_id']);

    // Prepare a delete statement
    $delete_query = "DELETE FROM messages WHERE id_m = '$message_id'";

    // Execute the delete statement
    if (mysqli_query($con, $delete_query)) {
        // Message deleted successfully
        // Redirect back to the chat page or display a success message
        header("Location: chat.php");
        exit(); // Stop further execution
    } else {
        // Error occurred while deleting the message
        // Redirect back to the chat page or display an error message
        header("Location: chat.php");
        exit(); // Stop further execution
    }
} else {
    // Message ID not provided
    // Redirect back to the chat page or display an error message
    header("Location: chat.php");
    exit(); // Stop further execution
}
?>
