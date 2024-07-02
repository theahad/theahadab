<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
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
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            background-color: #911955 !important;
            color: #fff;
            margin-top: 6px;
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
<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$servername = "localhost:3309";
$dbusername = "root";
$dbpassword = "";
$dbname = "cosmetics_register_db";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header ("location: user_index.php");
} else {
    echo "Error updating user: " . $conn->error;
}
}

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
            $username = $row["username"];
            $email = $row["email"];   
            $password = $row["password"];   
    } else {
        echo "User not Found.";
        exit;
    }
}
?>
    <!-- Sidebar -->
    <div class="sidebar">
                     <img src="<?php echo $_SESSION["profile_picture"]; ?>" alt="Profile Picture" class="profile-picture">
        <h3 class="sidebar-heading">Admin Panel</h3>
        <ul class="nav flex-column">
        <li class="nav-item">
                <a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#userManagementSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="userManagementSubmenu"><i class="fas fa-user"></i> User Management</a>
                <ul class="collapse" id="userManagementSubmenu">
                <?php if ($_SESSION["type"] !== 'customer') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">Manage Admin</a>
                    </li>
                <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_admin.php">Manage Customer</a>
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
        </ul>
        <ul class="nav flex-column mt-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Edit</a>
            <!-- Profile Dropdown -->
            <div class="dropdown ml-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: #911955;">
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 off set-md-3">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <input type="hidden" name="id" value="<?php echo $id?>">
    <div class="form-group">
    <label for="username">Username:</label><br>
    <input type="text"  name="username"  value="<?php echo $username;?>" required>
    </div>
    <div class="form-group">
    <label for="email">Email:</label><br>
    <input type="email"  name="email" value="<?php echo $email;?>" required>
    </div>
    <div class="form-group">
    <label for="password">Password:</label><br>
    </div>
    <input type="password"  name="password" required><br><br>

    <input type="submit" class="btn btn-primary" value="update
">
    </form>
    </div>
    </div>
        <!-- Main Content -->
        </div>
    </div>

        <!-- Main Content -->
       
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

   <script>
    // Update the UI with the retrieved data
    document.getElementById('totalUsers').textContent = userData.totalUsers;
</script>

</body>
</html>>