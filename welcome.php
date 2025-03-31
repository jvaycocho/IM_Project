<?php
session_start();
include 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        h3 {
            color: #555;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        td a:hover {
            color: #45a049;
        }

        .logout {
            text-align: center;
            margin: 20px 0;
        }

        .logout a {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .logout a:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    
    <!-- Logout Button -->
    <div class="logout">
        <a  href="login.php">Logout</a>
    </div>

    <h3>User List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Username</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['contact_num']}</td>
                <td>{$row['username']}</td>
                <td>{$row['pass']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> |
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Remove</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
