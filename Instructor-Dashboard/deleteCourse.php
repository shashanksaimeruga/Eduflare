<?php
    include '../connection.php';
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $course_id = intval($_GET['id']); 
    
        if ($course_id > 0) {
            
            $sql = "DELETE FROM courses WHERE course_id = $course_id";
    
            if ($conn->query($sql) === TRUE) {
                header("Location: coursesList.php"); 
                exit();
            } else {
                echo "Error deleting course: " . $conn->error;
            }
        } else {
            echo "Invalid course ID!";
        }
    } else {
        echo "No course ID provided!";
    }
    
    $conn->close();
?>