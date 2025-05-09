<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "gym");

if ($conn->connect_error) {
    echo json_encode(["message" => "Database connection failed."]);
    exit();
}

$user_id = $_POST['user_id'];
$date = $_POST['date'];
$status = $_POST['status'];

$sql = "INSERT INTO attendance (user_id, date, status) VALUES ('$user_id', '$date', '$status')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Attendance marked successfully!"]);
} else {
    echo json_encode(["message" => "Fail to mark attendance."]);
}

$conn->close();
?>
