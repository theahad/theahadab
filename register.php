<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    form {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 400px;
        box-sizing: border-box;
    }
    h2 {
        text-align: center;
        color: #911955; /* Dark pink/purple */
        margin-bottom: 20px;
        font-size: 24px;
    }
    .form-group {
        display: grid;
        grid-template-columns: 120px 1fr;
        align-items: center;
        margin-bottom: 15px;
    }
    .form-group label {
        color: #911955;
        text-align: right; /* Align labels to the right */
        margin-right: 10px;
    }
    .form-group input, .form-group select {
        padding: 10px;
        border: 1px solid #911955;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #911955;
        color: #ffffff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        width: 65%;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-top: 4px;
        margin-left: 120px;
    }
    input[type="submit"]:hover {
        background-color: #7a1444;
    }
    </style>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h2>Registration Form</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="type">User Type:</label>
            <select id="type" name="type" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture">
        </div>
        <input type="submit" value="Register">
        <p style="margin-top:10px; margin-left:105px;">Already have an account? 
            <a href="login.php">Log in</a>
        </p>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $type = $_POST["type"];

    // Handle profile picture upload
    $profile_picture = $_FILES["profile_picture"];
    $uploads_dir = 'uploads';

    // Ensure the uploads directory exists
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $profile_picture_path = $uploads_dir . "/" . basename($profile_picture["name"]);
    if (move_uploaded_file($profile_picture["tmp_name"], $profile_picture_path)) {
        $profile_picture_url = $profile_picture_path;
    } else {
        $profile_picture_url = ""; // or handle the error as needed
    }

    $servername = "localhost:3309";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "cosmetics_register_db";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password, phone, address, type, profile_picture) 
            VALUES ('$username', '$email', '$password', '$phone', '$address', '$type', '$profile_picture_url')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        session_start();
        $_SESSION["registration_success"] = true; // Set a session variable for registration success
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
</body>
</html>