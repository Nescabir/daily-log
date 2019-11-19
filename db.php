<?php

$host = $_ENV['DBHOST'];
$db   = $_ENV['DBNAME'];
$user = $_ENV['DBUSER'];
$pass = $_ENV['DBPWD'];
$charset = 'utf8mb4';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }