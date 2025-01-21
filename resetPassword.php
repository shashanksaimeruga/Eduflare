<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $security_answer = trim($_POST['security_answer']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Debugging output
    // echo "Debug: Email - $email, Security Answer - $security_answer<br>";

    // Verify email and security answer
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND (security_answer = ? OR security_answer IS NULL)");

    // $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND security_answer = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $security_answer);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            // echo "Debug: Match found<br>";
            error_log("Debug: Match found");
            // Update the password
            $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            if ($updateStmt) {
                $updateStmt->bind_param("ss", $hashedPassword, $email);
                if ($updateStmt->execute()) {
                    $stmt->close();
                    $updateStmt->close();
                    $conn->close();
                    // Redirect after successful reset
                    header("Location: Student-Dashboard/login.php");
                    exit;
                } else {
                    echo "Failed to update the password. Try again.";
                }
            } else {
                echo "Failed to prepare password update query.";
            }
        } else {
            echo "Invalid email or security answer.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare select query.";
    }

    $conn->close();
}
?>
