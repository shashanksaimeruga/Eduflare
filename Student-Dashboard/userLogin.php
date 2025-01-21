<?php
    session_start(); 
    include '../connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if (empty($email) || empty($password)) {
            echo "Please fill in both fields.";
        } else {
            
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
    
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['role'] = $row['role']; // Store user role in session
                    
                    // Check the role and redirect to the appropriate dashboard
                    if ($row['role'] == 'Student') {
                        header("Location: ../Student-Dashboard/dashboard.php"); 
                    } elseif ($row['role'] == 'Instructor') {
                        header("Location: ../Instructor-Dashboard/dashboard.php");
                    } else {
                        echo "Invalid role.";
                    }
                    
                    // header("Location: dashboard.php"); 
                    exit(); 
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "No user found with that email address.";
            }
        }
    }

?>
