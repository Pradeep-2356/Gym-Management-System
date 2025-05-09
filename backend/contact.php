<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
} else {
    echo "<script>alert('Failed to send message. Please try again.'); window.location.href='contact.php';</script>";
}

$stmt->close();
$conn->close();
?>
