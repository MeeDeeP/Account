<?php
session_start();
include_once('conn.php');
if(isset($_POST['Delete']))
{
    $id = $_POST['Delete'];

    try {
        $query = "DELETE FROM users WHERE user_id=:id";
        $statement = $conn->prepare($query);
        $data = [
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);
        
        if($query_execute)
        {
            $_SESSION['message'] = "Deleted";
            header('Location: index.php');
            session_destroy();
            exit(0);
        }

        else{ 
            $_SESSION['message'] = "Not updated";
            header('Location: index.php');
            exit(0);
        }

    } catch(PDOexception $e) {
        echo $e->getMessage();
    }
}
?>