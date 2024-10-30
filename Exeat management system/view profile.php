<?php
session_start(); // Start the session

// Include the database connection file
include 'db_connect.php'; // Adjust the path to your db_connect.php file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login page.html"); // Redirect to login page if not logged in
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the user's data from the database
$sql = "SELECT first_name, last_name, contact, email, ward_name, index_number, relation FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user's data
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

// Close the connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="View profile.css"> <!-- Link to the external CSS file -->
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="wp-block-site-logo">
                <a href="#" class="custom-logo-link" rel="home" aria-current="page">
                    <img width="200" height="120" src="images/UENR.png" class="custom-logo" alt="Exeat Management System" decoding="async"/>
                </a>
            </div>

            <div class="menu">
                <ul>
                    <li>
                        <a href="dashboard 1.html"><h1>Home</h1></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="profile-header">
                <img src="images/parent picking child.jpg" alt="User Profile Picture">
                <h1><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>
                <p>Relation to Ward: <?php echo htmlspecialchars($user['relation']); ?></p>
            </div>

            <div class="profile-details">
                <div class="section">
                    <h2>Personal Information</h2>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
                    <p><strong>Ward's Name:</strong> <?php echo htmlspecialchars($user['ward_name']); ?></p>
                    <p><strong>Ward's Index Number:</strong> <?php echo htmlspecialchars($user['index_number']); ?></p>
                </div>
                <div class="section">
                    <h2>Contact Information</h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
                </div>
            </div>

            <a href="Edit profile.html" class="edit-profile-btn">Edit Profile</a>
        </div>
    </div>

</body>
</html>
