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
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .navbar {
            background-color: #911955 !important;
            color: #fff;
            margin-top: 7px;
            z-index: 1000; /* Ensure navbar stays on top */
            width: 100%; /* Extend navbar full width */
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
        
        .profile-container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.65);
            width: 30%;
            height: 295px;
            max-width: 600px; /* Limit maximum width */
            margin: auto; /* Center horizontally */
            margin-top: 10px; /* Adjust top margin as needed */
        }
        
        .profile-container h2 {
            margin-bottom: 20px;
            font-size: 36px;
            color: #911955;
            font-weight: bold;
        }
        
        .profile-container p {
            margin: 10px 0;
            color: #911955;
        }
        
        .profile-container a {
            display: inline-block;
            margin-top: 10px; /* Adjusted margin */
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            transition: color 0.3s ease, border-color 0.3s ease;
        }
        
        .profile-container a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            transition: border-color 0.3s ease-in-out;
            z-index: -1;
        }
        
        .profile-container a:hover::before {
            border-color: #911955;
            transform: scale(1.2);
        }
        
        .profile-container a:hover {
            color: #911955;
        }
        
        .profile-container2 img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            margin-left: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="profile-container2"><?php if (!empty($row['profile_picture'])): ?>
            <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture">
        <?php endif; ?></div>
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
            <a class="navbar-brand" href="#">Profile</a>
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



    <div class="profile-container">
        <!-- <?php if (!empty($row['profile_picture'])): ?>
            <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture">
        <?php endif; ?> -->
        <h1 style="font-weight:bold; color:#911955;"><?php echo htmlspecialchars($row['username']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($row['phone']); ?></p>
        <p>Address: <?php echo htmlspecialchars($row['address']); ?></p>
        <p>User Type: <?php echo htmlspecialchars($row['type']); ?></p>
        <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
    </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
