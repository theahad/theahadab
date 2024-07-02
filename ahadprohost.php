<?php

$server = "sql302.infinityfree.com";
$username = "if0_36819961";
$password = "nxkuUysKMRe1WD";
$dbname = "if0_36819961_ahadprohost";

$conn = mysqli_connect($server, $username, $password, $dbname);

if(!conn){
    die("connection Failed:".mysqli_connect_error());
}

?>