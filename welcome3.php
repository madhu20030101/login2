<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: index.html");
    exit;
}

$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Main Welcome Box Styling */
        .welcome-container {
            text-align: center;
            background-color: #2196F3;
            color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Heading Styling */
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        /* Button Styling */
        .logout-btn {
            padding: 15px 30px;
            background-color: #f44336;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover Effect on Button */
        .logout-btn:hover {
            background-color: #d32f2f;
            transform: scale(1.05);
        }

        /* Link Styling for Logout */
        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #f44336;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .welcome-container {
                padding: 20px;
                width: 90%;
            }

            h1 {
                font-size: 26px;
            }

            .logout-btn {
                font-size: 14px;
                padding: 12px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <a href="index.html" class="logout-btn">Logout</a>
    </div>
</body>
</html>
