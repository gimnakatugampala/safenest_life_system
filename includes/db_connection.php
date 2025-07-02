<?php
$host = 'localhost';            // or 127.0.0.1
$db   = 'safenest_db';   // 🔁 Change this to your DB name
$user = 'root';         // 🔁 Your MySQL username
$pass = '';     // 🔁 Your MySQL password
$port = 3306;                   // default MySQL port

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Optional: Set charset
$conn->set_charset("utf8mb4");

// Success message (for testing only — remove in production)
// echo "✅ Connected to database successfully";
?>
