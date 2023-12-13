<?php
    session_start();

    // Assuming you have stored user details in the session
    // Adjust this based on how you handle user sessions
    $user_id = $_SESSION['user'];

    // Update user activity status to 0 (logged out)
    require_once 'conn.php'; // Include your database connection file
    $updateActivitySql = "UPDATE `users` SET `activity` = 0 WHERE `user_id` = :user_id";
    $updateActivityQuery = $conn->prepare($updateActivitySql);
    $updateActivityQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($updateActivityQuery->execute()) {
        // Successfully updated activity status

        // Destroy the session
        session_destroy();

        // Redirect to the login page or any other page as needed
        header('location: index.php');
    } else {
        // Error updating activity status
        echo "Error updating activity: " . $updateActivityQuery->errorInfo()[2];
    }
?>
