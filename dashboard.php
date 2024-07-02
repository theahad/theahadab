<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
$servername = "localhost:3309";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "cosmetics_register_db";

    $conn = new mysqli($servername,  $dbusername, $dbpassword,  $dbname);

    if ($conn->connect_error){
        die("connection failed:" . $conn->connect_error);
    }
    $sql = "SELECT COUNT(*) as totalUsers FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $totalUsers = $row["totalUsers"];

        $userData = array('totalUsers' => $totalUsers);
        $userDataJason = json_encode($userData);

        echo "<script>var userData = $userDataJason;</script>";
    }

    $product_count_query = "SELECT COUNT(*) as totalProducts FROM product";
$product_count_result = $conn->query($product_count_query);
if ($product_count_result->num_rows > 0) {
    $product_count_row = $product_count_result->fetch_assoc();
    $totalProducts = $product_count_row["totalProducts"];
} else {
    $totalProducts = 0;
}


$jewellery_count_query = "SELECT COUNT(*) as totaljewellery FROM jewellery";
$jewellery_count_result = $conn->query($jewellery_count_query);
if ($jewellery_count_result->num_rows > 0) {
    $jewellery_count_row = $jewellery_count_result->fetch_assoc();
    $totaljewellery = $jewellery_count_row["totaljewellery"];
} else {
    $totaljewellery = 0;
}
    
    $conn->close();
?>

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
            margin-top: -50px;
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
<h1>Admin panel</h1>
    <!-- Sidebar -->
    <div class="sidebar">
     <img src="<?php echo $_SESSION["profile_picture"]; ?>" alt="Profile Picture" class="profile-picture">
        <h3 class="sidebar-heading">Admin Panel</h3>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt"></i> Profile</a>
            </li>
            <li class="nav-item">
            <?php if ($_SESSION["type"] !== 'customer') { ?>
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
    <!-- Page Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <!-- Profile Dropdown -->
            <div class="dropdown ml-auto">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: #911955;">
                    <span class="status-circle"></span> <!-- Green status circle -->
                    <span class="mr-2"></span><?php echo $_SESSION["username"];?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    


        <!-- Main Content -->
        <div class="container-fluid">
            <h1 style="color: #911955;">Welcome to the Admin Dashboard!</h1>
            <p>This is the main content area where you can manage users, settings, and products.</p>
            
            <!-- Analysis Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text" id="totalUsers">Loading...</p> <!-- Add id attribute -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Products</h5>
                <p class="card-text"><?php echo $totalProducts; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Jewellery</h5>
                <p class="card-text"><?php echo $totaljewellery; ?></p>
            </div>
        </div>
    </div>
            </div>

            <!-- Chart Section -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Activity</h5>
                            <canvas id="userActivityChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Sales</h5>
                            <canvas id="productSalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Dummy Chart Data -->
    <script>
        // Dummy data for charts
        const userActivityData = [10, 20, 30, 40, 50, 60, 70];
        const productSalesData = [5, 10, 15, 20, 25, 30, 35];

        // Chart.js
        var userActivityChart = new Chart(document.getElementById('userActivityChart'), {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'User Activity',
                    data: userActivityData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var productSalesChart = new Chart(document.getElementById('productSalesChart'), {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Product Sales',
                    data: productSalesData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

   <script>
    // Update the UI with the retrieved data
    document.getElementById('totalUsers').textContent = userData.totalUsers;
</script>


</body>
</html>