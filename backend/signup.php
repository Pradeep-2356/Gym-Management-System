<?php
// Enable errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include DB connection
include 'db.php';

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect POST data
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';

    // Validate
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all fields.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email already exists.";
        exit;
    }

    // Insert user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Signup successful!";
    } else {
        echo "Database error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
