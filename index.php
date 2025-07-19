<?php
session_start();
require 'db.php'; 
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-color: #d8f4ff;
            font-family: Arial, sans-serif;
        }

        .login-box {
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #aaa;
            text-align: center;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .login-box input[type="submit"] {
            padding: 10px 20px;
            background-color: #00aaff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-box input[type="submit"]:hover {
            background-color: #0077aa;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
