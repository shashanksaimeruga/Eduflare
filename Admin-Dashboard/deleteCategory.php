<?php
    include '../connection.php';
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = intval($_GET['id']); 
    
        if ($id > 0) {
            
            $sql = "DELETE FROM categories WHERE id = $id";
    
            if ($conn->query($sql) === TRUE) {
                header("Location: categoriesList.php"); 
                exit();
            } else {
                echo "Error deleting category: " . $conn->error;
            }
        } else {
            echo "Invalid category ID!";
        }
    } else {
        echo "No category ID provided!";
    }
    
    $conn->close();
?>