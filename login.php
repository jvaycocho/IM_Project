<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <STYle>body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
}

h2 {
    color: #1877f2;
    margin-bottom: 20px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #1877f2;
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
    background-color: #165ecc;
}

.error-box {
    background: #ffdddd;
    color: red;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid red;
    border-radius: 6px;
}

.signup-link {
    margin-top: 15px;
    font-size: 14px;
}

.signup-link a {
    color: #1877f2;
    text-decoration: none;
    font-weight: bold;
}

.signup-link a:hover {
    text-decoration: underline;
}
</STYle>
</head>
<body>
<div class="container">
    <h2>Login</h2>

    <?php if (!empty($error_message)) : ?>
        <div class="error-box"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="submit" value="Log In">
    </form>

    <div class="signup-link">
        Don't have an account? <a href="register.php">Sign up</a>
    </div>
</div>
</body>
</html>

<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['pass']) { // Direct password comparison (no hashing)
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}

$conn->close();
?>
