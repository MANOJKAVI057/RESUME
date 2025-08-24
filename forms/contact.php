<?php
$host = "localhost";
$dbname = "contact_form";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed.";
    exit();
}
$name    = $conn->real_escape_string($_POST['name'] ?? '');
$email   = $conn->real_escape_string($_POST['email'] ?? '');
$subject = $conn->real_escape_string($_POST['subject'] ?? '');
$message = $conn->real_escape_string($_POST['message'] ?? '');
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "All fields are required.";
    exit();
}
$sql = "INSERT INTO messages (name, email, subject, message) 
        VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql)) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Failed to send message: " . $conn->error;
}
$conn->close();
?>