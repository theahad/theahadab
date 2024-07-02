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

// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $delete_C_ID = $_GET["id"];
    
    // Check if the value is an integer
    if (!filter_var($delete_C_ID, FILTER_VALIDATE_INT)) {
        die("Invalid company ID.");
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete all related products
        $sql = "DELETE FROM product WHERE C_ID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $delete_C_ID);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Error preparing statement for product deletion: " . $conn->error);
        }

        // Delete the company
        $sql = "DELETE FROM company WHERE C_ID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $delete_C_ID);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Error preparing statement for company deletion: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();
        header("Location: company_index.php");
        exit();

    } catch (Exception $e) {
        // Rollback transaction if there is any error
        $conn->rollback();
        die("Transaction failed: " . $e->getMessage());
    }
} else {
    die("ID parameter missing or empty.");
}

$conn->close();
?>
