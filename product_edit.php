<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$servername = "localhost:3309";
$dbusername = "root";
$dbpassword = "";
$dbname = "cosmetics_register_db";

// Create a new connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$productID = "";
$productName = "";
$cID = "";
$manufacturingDate = "";
$expiryDate = "";
$price = "";

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the product ID from the URL
    $productID = $_GET['id'];

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM product WHERE ProductID = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row["ProductName"];
        $cID = $row["C_ID"];
        $manufacturingDate = $row["ManufacturingDate"];
        $expiryDate = $row["ExpiryDate"];
        $price = $row["Price"];
    } else {
        echo "Product not found.";
        exit;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the product ID is not provided in the URL, redirect the user back to the product index page
    header("location: product_index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = $_POST["ProductID"];
    $productName = $_POST["ProductName"];
    $cID = $_POST["C_ID"];
    $manufacturingDate = $_POST["ManufacturingDate"];
    $expiryDate = $_POST["ExpiryDate"];
    $price = $_POST["Price"];

    // Prepare an update statement
    $stmt = $conn->prepare("UPDATE product SET ProductName=?, C_ID=?, ManufacturingDate=?, ExpiryDate=?, Price=? WHERE ProductID=?");
    $stmt->bind_param("sssssi", $productName, $cID, $manufacturingDate, $expiryDate, $price, $productID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Product updated successfully.";
        header("location: product_index.php");
        exit;
    } else {
        echo "Error updating product: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
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
            margin-top: -74px;

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
                <a class="nav-link" href="contact_us.php"><i class="fas fa-box"></i> Contact Management</a>
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
                
            <a class="navbar-brand" href="#">Product Edit</a>

            <!-- Profile Dropdown -->
            <div class="dropdown ml-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: #911955;">
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
        <div class="row">
            <div class="col-md-6 off set-md-3">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $productID; ?>" method="POST">
        <input type="hidden" name="ProductID" value="<?php echo $productID; ?>">
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" value="<?php echo $productName; ?>" required><br>
        <label for="C_ID">Company ID:</label>
        <input type="text" name="C_ID" value="<?php echo $cID; ?>" required><br>
        <label for="ManufacturingDate">Manufacturing Date:</label>
        <input type="text" name="ManufacturingDate" value="<?php echo $manufacturingDate; ?>" required><br>
        <label for="ExpiryDate">Expiry Date:</label>
        <input type="text" name="ExpiryDate" value="<?php echo $expiryDate; ?>" required><br>
        <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?php echo $price; ?>" required><br>
        <input type="submit" class="btn btn-primary margin" value="Update">
    </form>
    </div>
    </div>
    </div>

        <!-- Main Content -->
        

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Dummy Chart Data -->
   
   <script>
    // Update the UI with the retrieved data
    document.getElementById('totalUsers').textContent = userData.totalUsers;
</script>
</body>
</html>