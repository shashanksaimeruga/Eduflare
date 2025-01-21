<?php
    include '../connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $full_name = $_POST['full_name'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
    
        // Validation
        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            echo "All fields are required!";
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            
            $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    
    //         if ($stmt = $conn->prepare($query)) {
    //             $stmt->bind_param("sss", $name, $email, $hashed_password, $role);
    //             if ($stmt->execute()) {
    //                 echo "Registration successful!";
    //                 // Redirect to the login page after successful registration
    //                 header("Location: Student-Dashboard/login.php");
    //                 exit();
    //             } else {
    //                 echo "Error: " . $stmt->error;
    //             }
    //             $stmt->close();
    //         } else {
    //             echo "Error: " . $conn->error;
    //         }
    
    //         $conn->close();
    //     }
    // }
    
    if ($stmt = $conn->prepare($query)) {
                // Bind the parameters (four parameters: name, email, hashed_password, role)
                $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
    
                // Execute the statement
                if ($stmt->execute()) {
                    // echo "Registration successful!";
                    
                    // Redirect to the login page after successful registration
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
    
                // Close the statement
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
    
            // Close the connection
            $conn->close();
        }
    }
?>
