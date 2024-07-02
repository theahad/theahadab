<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost:3309";
$dbusername = "root";
$dbpassword = "";
$dbname = "cosmetics_register_db";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found";
    exit;
}

// Update Profile Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if a new profile picture is uploaded
    if ($_FILES['profile_picture']['error'] === 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                // Update database with new profile picture path
                $profile_picture = $target_file;
                $update_sql = "UPDATE users SET username='$username', phone='$phone', address='$address', profile_picture='$profile_picture' WHERE email='$email'";
                if ($conn->query($update_sql) === TRUE) {
                    // Redirect to profile page after successful update
                    header("Location: profile.php");
                    exit;
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update database without changing profile picture
        $update_sql = "UPDATE users SET username='$username', phone='$phone', address='$address' WHERE email='$email'";
        if ($conn->query($update_sql) === TRUE) {
            // Redirect to profile page after successful update
            header("Location: profile.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #911955;
            color: #fff;
            padding-top: 50px;
        }
        .sidebar-heading {
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        .nav-link {
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .navbar {
            background-color: #911955 !important;
            color: #fff;
            z-index: 1000; /* Ensure navbar stays on top */
            width: 100%; /* Extend navbar full width */
            margin-top: 7px;
        }
        
        .navbar-brand {
            color: #fff;
        }
        
        .status-circle {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: green;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 440px;
            height:500px;
            margin: auto;
            margin-top: 2px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        }
        .form-group {
            margin-bottom: 1px;
        }
        .form-group label {
            font-weight: bold;
        }
    
        .profile-img {
            width: 140px;
            height: 134px;
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.80);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        } 
        
        /* for profile pic display on sidebar */
        .profile-picture {
            width: 100px;
            height: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            border-radius: 50%;
            object-fit: cover;
            margin-left: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
                <img src="<?php echo $_SESSION["profile_picture"]; ?>" alt="Profile Picture" class="profile-picture">
        <h3 class="sidebar-heading">Admin Panel</h3>
        <ul class="nav flex-column">
        <li class="nav-item">
                <a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt"></i> Profile</a>
            </li>
            <li class="nav-item">
            <?php if ($_SESSION["type"] !== 'customer') { ?>
            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

            </li>
            <li class="nav-item">
            <a class="nav-link" href="#userManagementSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="userManagementSubmenu"><i class="fas fa-user"></i> User Management</a>
                <ul class="collapse" id="userManagementSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">Manage Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer_index.php">Manage Customer</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product_index.php"><i class="fas fa-box"></i> Product Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="jewellery_index.php"><i class="fas fa-box"></i> Jwellery Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="company_index.php"><i class="fas fa-box"></i> Company Management</a>
            </li>
            
            <li class="nav-item">
            <a class="nav-link" href="#SettingsSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="SettingsSubmenu"><i class="fas fa-user"></i> Settings</a>
            <ul class="collapse" id="SettingsSubmenu">
            <li class="nav-item">
                        <a class="nav-link" href="setting.php">Logs</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
        </ul>
        <ul class="nav flex-column mt-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Edit Profile</a>
            <!-- Profile Dropdown -->
            <div class="dropdown ml-auto">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: #911955;">
                    <span class="status-circle"></span> <!-- Green status circle -->
                    <span class="mr-2"><?php echo $_SESSION["username"]; ?></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    </div>


<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
        </div>
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <br>
            <?php if (!empty($row['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" class="profile-img" alt="Current Profile Picture">
            <?php endif; ?>
            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
