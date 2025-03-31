<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM user WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully. <a href='welcome.php'>Back to Users</a>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>