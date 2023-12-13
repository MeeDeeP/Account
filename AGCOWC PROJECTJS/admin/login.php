<?php
session_start();
include('dbcon.php');

$out = array('error' => false);

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == '') {
    $out['error'] = true;
    $out['message'] = "Username is required";
} elseif ($password == '') {
    $out['error'] = true;
    $out['message'] = "Password is required";
} else {
    // Use PDO prepared statement and MD5 hashing for the password
    $hashedPassword = md5($password);

    try {
        $stmt = $conn->prepare("SELECT * FROM admin2 WHERE admin_username=:username AND admin_password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $row['id'];
            $out['message'] = "Login Successful";
        } else {
            $out['error'] = true;
            $out['message'] = "Login Failed. User not Found";
        }
    } catch (PDOException $e) {
        $out['error'] = true;
        $out['message'] = "Error: " . $e->getMessage();
    }
}

$conn = null; // Close the connection

header("Content-type: application/json");
echo json_encode($out);
die();
?>
