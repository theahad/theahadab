<?php
session_start();

$success_message = '';
$error_message = '';

if (isset($_SESSION["registration_success"]) && $_SESSION["registration_success"]) {
    $success_message = '<p style="color: green; font-weight: bold; margin-top: 10px;">You have been registered successfully. Please login to continue.</p>';
    unset($_SESSION["registration_success"]); // Clear the session variable
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost:3309";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "cosmetics_register_db";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["password"])) { // Verify the hashed password
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $row["username"];
            $_SESSION["type"] = $row["type"];
            $_SESSION["profile_picture"] = $row["profile_picture"]; // Assuming 'profile_picture' column exists
            $_SESSION["last_activity"] = time(); // Set session timeout

            if ($row["type"] == 'admin') {
                header("Location: dashboard.php");
                exit;
            } else {
                header("Location: profile.php");
                exit;
            }
        } else {
            $error_message = "Invalid email or password";
        }
    } else {
        $error_message = "Invalid email or password";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #f7f7f7; /* Light grey background for subtle contrast */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            margin-top: 100px; /* Adjusted margin for spacing */
        }
        h2 {
            text-align: center;
            color: #911955; /* Dark pink/purple */
            margin-bottom: 20px;
            font-size: 24px;
        }
        form {
            padding: 20px; /* Added padding for form elements */
        }
        label {
            color: #911955;
            margin-right: 10px;
            text-align: right;
        }
        input[type="email"], input[type="password"] {
            padding: 10px;
            border: 1px solid #911955;
            border-radius: 5px;
            width: calc(100% - 22px);
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #911955;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 92%;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #7a1444;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
        .success-message {
            color: green;
            margin-top: 10px;
            font-weight: bold;
        }
        .register-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>LOGIN</h2>
        <?php echo $success_message; ?>
        <?php if (isset($error_message)) { echo '<p class="error-message">' . $error_message . '</p>'; } ?>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Log in">
    </form>
    <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
