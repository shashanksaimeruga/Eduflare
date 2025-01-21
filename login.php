<?php
    session_start(); 
    include 'connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if (empty($email) || empty($password)) {
            echo "Please fill in both fields.";
        } else {
            
            $query = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
            
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
    
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_email'] = $row['email'];
                    header("Location: add-property.php"); 
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
