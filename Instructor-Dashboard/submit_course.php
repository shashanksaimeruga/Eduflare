<?php
    session_start();
    include '../connection.php';

    // $user_id = $_SESSION['user_id'];
    
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if not logged in
        header("Location: ../Student-Dashboard/login.php");
        exit();
    }
    
    // Get the logged-in instructor's ID
    $instructor_id = $_SESSION['user_id'];

 
    function cleanInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize inputs
        $course_name = cleanInput($_POST['course_name']);
        $course_description = cleanInput($_POST['course_description']);
        $category_type = cleanInput($_POST['category_type']); 
        $quiz = cleanInput($_POST['quiz']);
        $optionA = cleanInput($_POST['optionA']);
        $optionB = cleanInput($_POST['optionB']);
        $optionC = cleanInput($_POST['optionC']);
        $optionD = cleanInput($_POST['optionD']);

    
    // Directory to store videos
    $video_target_dir = __DIR__ . "/CourseVideos/";
    
    // Debug: Check if the directory exists and is writable
    if (!is_dir($video_target_dir) || !is_writable($video_target_dir)) {
        die("Error: The directory $video_target_dir does not exist or is not writable.");
    }

    // echo "Resolved directory path: " . $video_target_dir;

    // Handle multiple videos
    $media_files = [];
    foreach ($_FILES['media']['name'] as $key => $video_name) {
        $tmp_name = $_FILES['media']['tmp_name'][$key];
        $media_file = $video_target_dir . basename($video_name);
        $media_type = strtolower(pathinfo($media_file, PATHINFO_EXTENSION));
        
        // // Debug: Output file details
        // echo "Trying to upload: $video_name <br>";
        // echo "Temp name: $tmp_name <br>";
        // echo "Target file: $media_file <br>";
        // echo "File type: $media_type <br>";

        // Validate video file type and size
        if (in_array($media_type, ['mp4', 'avi', 'mov']) &&
            $_FILES['media']['size'][$key] <= 50000000) {
            if (is_uploaded_file($tmp_name)) {
                if (move_uploaded_file($tmp_name, $media_file)) {
                    // Add uploaded video file name to array
                    $media_files[] = basename($video_name);
                } else {
                    echo "Error: Could not move file $video_name to $media_file.<br>";
                }
            } else {
                echo "Error: $video_name is not a valid uploaded file.<br>";
            }
        } else {
            echo "Invalid file type or size for: $video_name.<br>";
        }
    }

    // Convert media files array to a comma-separated string
    $media_files_string = implode(", ", $media_files);

    // SQL Insert Query
    // $sql = "INSERT INTO courses (course_name, course_description, media, created_at)
    //         VALUES ('$course_name', '$course_description', '$media_files_string', NOW())";


    $sql = "INSERT INTO courses (course_name, course_description, category_type, media, instructor_id, quiz, optionA, optionB, optionC, optionD, created_at)
            VALUES ('$course_name', '$course_description', '$category_type', '$media_files_string', '$instructor_id', '$quiz', '$optionA', '$optionB', '$optionC', '$optionD',  NOW())";



    if ($conn->query($sql) === TRUE) {
            header("Location: addcourse.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }

?>
