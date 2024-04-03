<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $conn = new mysqli("localhost", "root", "", "my_port");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO registration (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo '<span style="color: green;">Form submitted successfully</span>';
    } else {
        echo '<span style="color: red;">Error: ' . $conn->error . '</span>';
    }

    $stmt->close();
    $conn->close();
}
?>
