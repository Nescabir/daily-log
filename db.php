<?php

$host = $_ENV['DBHOST'];
$db   = $_ENV['DBNAME'];
$user = $_ENV['DBUSER'];
$pass = $_ENV['DBPWD'];
$charset = 'utf8mb4';

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";