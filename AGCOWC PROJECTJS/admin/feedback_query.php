<?php
require 'dbcon.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sql = $conn->prepare("SELECT * FROM feedback INNER JOIN users ON feedback.user_id = users.user_id WHERE user_email LIKE :search OR user_feedback LIKE :search OR user_fname LIKE :search");
    $sql->bindValue(':search', '%' . $search . '%');
} else {
    $sql = $conn->prepare("SELECT * FROM feedback INNER JOIN users ON feedback.user_id = users.user_id");
}

$sql->execute();

$results = $sql->fetchAll(PDO::FETCH_ASSOC);

// Output results as JSON
echo json_encode($results);
?>
