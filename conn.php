<?php $servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ssm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
?>