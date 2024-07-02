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
     if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $delete_id = $_GET["id"];

        $sql = "DELETE FROM users WHERE id = ?";
        if($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $delete_id);
            if($stmt->execute()) {
                header("Location: customer_index.php");
                exit();

            } else {
                echo "Error deleting record:" . $conn->error;
            }
        }
     }
?>
