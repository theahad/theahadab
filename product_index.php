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

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

// $conn->close();
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

    <!-- dropdown open -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

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

        /* for dropdown */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #911955;
            color: #fff;
        }
        
        .nav-link {
            color: #fff;
        }
        .nav-link:hover {
            color: #ffc107;
        }
       

    .table {
        width: 105%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 6px;
        text-align: left;
        white-space: nowrap;
    }             

    .table th:last-child,
    .table td:last-child {
        text-align: center;
    }
.action-buttons a {
        margin: 0 5px;
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
                <a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt"></i> Profile</a>
            </li>
            <li class="nav-item">
            <?php if ($_SESSION["type"] !== 'customer') { ?><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

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
            <a class="navbar-brand" href="#">Product Management</a>
            <!-- Profile Dropdown -->
            <div class="dropdown ml-auto">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: #911955;">
                    <span class="status-circle"></span> <!-- Green status circle -->
                    <span class="mr-2"></span><?php echo $_SESSION["username"];?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-3">
        <div class="col">
        <?php if ($_SESSION["type"] !== 'customer') { ?>   
        <a href="product_create.php" class="btn btn-primary">Create products</a>
        <?php } ?>

        </div>
        </div>
        <div class="row">
        <div class="col">
        <div class="table-container">
    <table class="table">
                <thead>
                    <tr>
                        <th>ProductID</th>
                        <th>ProductName</th>
                        <th>Company Name</th>
                        <th>ManufacturingDate</th>
                        <th>ExpiryDate</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ProductID'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                
                        // Fetching company name instead of company ID
                        $company_query = "SELECT C_Name FROM company WHERE C_ID = " . $row['C_ID'];
                        $company_result = $conn->query($company_query);
                        if ($company_result->num_rows > 0) {
                            $company_row = $company_result->fetch_assoc();
                            $company_name = $company_row['C_Name'];
                            echo "<td>" . $company_name . "</td>";
                        } else {
                            echo "<td>Company Not Found</td>";
                        }
                
                        echo "<td>" . $row['ManufacturingDate'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Price'] . "</td>";
                        echo "<td>";
                        echo "<a href='product_show.php?id=" . $row['ProductID'] . "' class='btn btn-primary btn-sm mr-2'>View</a>";
                        if ($_SESSION["type"] !== 'customer') {
                            echo "<a href= 'product_edit.php?id=" . $row["ProductID"] . "' class = 'btn btn-info btn-sm mr-2'>Edit</a>";
                            echo "<a href='product_delete.php?id=" . $row['ProductID'] . "' class='btn btn-danger btn-sm mr-2'>Delete</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- dropdown open -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
