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

// Fetch the user's data from the database for pre-filling the form
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

// Handle form submission for updating profile information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and assign form inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $ward_name = mysqli_real_escape_string($conn, $_POST['ward_name']);
    $index_number = mysqli_real_escape_string($conn, $_POST['index_number']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);

    // Update the user's data in the database
    $sql = "UPDATE users SET first_name = ?, last_name = ?, contact = ?, email = ?, ward_name = ?, index_number = ?, relation = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $contact, $email, $ward_name, $index_number, $relation, $user_id);

    if ($stmt->execute()) {
        // Redirect to the profile page after successful update
        header("Location: view profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            <h1>Edit Profile</h1>
            <form action="edit_profile.php" method="post">
                <div class="section">
                    <h2>Personal Information</h2>
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br>

                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br>

                    <label for="ward_name">Ward's Name:</label>
                    <input type="text" id="ward_name" name="ward_name" value="<?php echo htmlspecialchars($user['ward_name']); ?>" required><br>

                    <label for="index_number">Ward's Index Number:</label>
                    <input type="text" id="index_number" name="index_number" value="<?php echo htmlspecialchars($user['index_number']); ?>" required><br>

                    <label for="relation">Relation to Ward:</label>
                    <select id="relation" name="relation" required>
                        <option value="MOTHER" <?php echo $user['relation'] == 'MOTHER' ? 'selected' : ''; ?>>Mother</option>
                        <option value="FATHER" <?php echo $user['relation'] == 'FATHER' ? 'selected' : ''; ?>>Father</option>
                        <option value="OTHERS" <?php echo $user['relation'] == 'OTHERS' ? 'selected' : ''; ?>>Other</option>
                    </select><br>
                </div>

                <div class="section">
                    <h2>Contact Information</h2>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

                    <label for="contact">Phone:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required><br>
                </div>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

</body>
</html>
