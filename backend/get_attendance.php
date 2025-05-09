<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM attendance WHERE user_id = ? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $attendance = [];
    while ($row = $result->fetch_assoc()) {
        $attendance[] = $row;
    }
    
    echo json_encode($attendance);
    $stmt->close();
}
?>
