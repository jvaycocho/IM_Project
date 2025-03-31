<?php

include 'connection.php';

// Fetch user details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();
}

// Update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $query = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    $sql = "UPDATE id SET first_name='$first_name', last_name='$last_name', contact_num='$contact_number', username='$username', pass='$password' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully. <a href='welcome.php'>Back to Users</a>";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit User</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>
            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" value="<?php echo $user['contact_num']; ?>" required><br>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
            <label for="password">Password:</label>
            <input type="text" name="password" value="<?php echo $user['pass']; ?>" required><br>
            <input type="submit" value="Update">
        </form>
    </div>

</body>
</html>
