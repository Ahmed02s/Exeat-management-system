<?php
session_start(); // Start the session

include 'db_connect.php'; // Include the database connection file

// Check for the signup success message
if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
    echo "<p style='color: green;'>ACCOUNT HAS BEEN SUCCESSFULLY CREATED. PLEASE LOG IN</p>";
}

if (isset($_POST['login'])) {
    // Sanitize and assign form inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);

    // Check if email and password are provided
    if (!$email || !$user_password) {
        echo "Both email and password are required.";
    } else {
        // Fetch the user from the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($user_password, $user['user_password'])) {
                // Set session variables for the logged-in user
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'];

                // Redirect to the dashboard
                header("Location: dashboard 1.html");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
    }
}
?>
