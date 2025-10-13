<?php
$servername = "localhost";
$username = "root";
$password = "";


$dbname = "employee_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db($dbname);

// Create employees table
$sql = "CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    address TEXT NOT NULL,
    joining_date DATE NOT NULL,
    shift_time TIME NOT NULL,
    employee_id INT NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL,
    skills VARCHAR(255),
    availability BOOLEAN NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";


if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

$conn->close();
echo "Database and table created successfully";
?>