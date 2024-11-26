<?php
// Start session
session_start();

// Database configuration
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "project"; // Database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data and sanitize
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password']; // Password should not be sanitized as it's matched as is

// Query to get the user's details
$sql = "SELECT name, password FROM employees WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database query failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dbPassword = $row['password']; // Password from database
    $name = $row['name']; // Name from database

    // Check if entered password matches the one in the database
    if ($password === $dbPassword) {
        // Store name in session
        $_SESSION['name'] = $name;

        // Redirect to welcome3.php
        header("Location: welcome3.php");
        exit;
    } else {
        // Incorrect password
        echo "<script>
            alert('Incorrect password.');
            window.location.href = 'index.html';
        </script>";
        exit;
    }
} else {
    // Email not found
    echo "<script>
        alert('Email not found.');
        window.location.href = 'index.html';
    </script>";
    exit;
}

// Close connection
$stmt->close();
$conn->close();
?>
