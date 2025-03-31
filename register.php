<?php
include 'connection.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $check_query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        $error_message = "Error: Username already exists. Try another one.";
    } else {
        $sql = "INSERT INTO user (first_name, last_name, contact_num, username, pass) 
                VALUES ('$first_name', '$last_name', '$contact_number', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Registration successful. <a href='login.php'>Login Here</a>";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-Like Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #1877f2;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            width: 400px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #42b72a;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #36a420;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
        }

        .message a {
            color: #1877f2;
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>



<div class="container">
    <h2>Sign up Here!</h2>
    
    <form method="post">
        <input type="text" name="first_name" placeholder="First name" required>
        <input type="text" name="last_name" placeholder="Last name" required>
        <input type="text" name="contact_number" placeholder="Mobile number" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="New password" required>

        <input type="submit" value="Sign Up" >
    </form>

    <div class="message">
        <?php 
            if (!empty($success_message)) {
                echo "<span style='color: green;'>$success_message</span>";
            }
            if (!empty($error_message)) {
                echo "<span style='color: red;'>$error_message</span>";
            }
        ?>
    </div>
</div>

</body>
</html>
