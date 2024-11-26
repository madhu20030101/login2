<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "";      // Replace with your MySQL password
$dbname = "project"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $empid = $_POST['empid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Check if the email already exists in the database
    $sql = "SELECT * FROM employees WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email is already taken. Please use a different email.";
        $stmt->close();  // Close the prepared statement
        exit();
    }
    $stmt->close();  // Close the prepared statement after the check

    // Prepare SQL query to insert the new user into the database
    $sql = "INSERT INTO employees (empid, name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $empid, $name, $email, $password);

    if ($stmt->execute()) {
        // Start a session to store user data
        session_start();
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['empid'] = $empid;
        $_SESSION['name'] = $name;

        // Redirect to welcome page
        header("Location: welcome.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
