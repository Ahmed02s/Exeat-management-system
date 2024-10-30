<?php
include 'db_connect.php'; // Include the database connection file

if (isset($_POST['submit'])) {
    // Sanitize and assign form inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $ward_name = mysqli_real_escape_string($conn, $_POST['ward_name']);
    $index_number = mysqli_real_escape_string($conn, $_POST['index_number']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    $confirm_user_password = mysqli_real_escape_string($conn, $_POST['confirm_user_password']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);

    // Ensure passwords match
    if ($user_password !== $confirm_user_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Password hashing
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, contact, email, ward_name, index_number, user_password, relation) 
            VALUES ('$first_name', '$last_name', '$contact', '$email', '$ward_name', '$index_number', '$hashed_password', '$relation')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login page.html?registration=success");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
if ($conn->query($sql) === TRUE) {
    // Redirect to login page with a success message
    header("Location: login.php?signup=success");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
