<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
    header("Location: signup.html"); // Redirect to the signup page if not logged in
    exit();
}

// Get the logged-in user's name from the session
$userName = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        .welcome-message {
            text-align: center;
            font-size: 24px;
            padding: 20px;
            background-color: #2196F3;
            color: white;
            border-radius: 10px;
        }

        .logout-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <div class="welcome-message">
        <h1>Welcome, <?php echo $userName; ?>!</h1>
        <a href="index.html" class="logout-btn">Logout</a>

    </div>

    

</body>
</html>
