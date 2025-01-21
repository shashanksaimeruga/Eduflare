<?php

    // Database connection
    // $conn = mysqli_connect("aahantechnologies.com", "raadh5xq_M3M", "4AgE[Xjw*+0F", "raadh5xq_M3M") or die('Problem in connection');
    session_start(); 
    include 'connection.php';
    
    // email details
    $to = "diksha@aahantechnologies.com"; 
    $from = $_REQUEST['email'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone'];
    $message = $_REQUEST['message'];
    $headers = "From: $from";
    $subject = "Contact Form EduFlare Site";
    
    // email content
    $fields = array(
        "first_name" => "First name",
        "last_name" => "Last name",
        "email" => "Email",
        "phone" => "Phone",
        "message" => "Message"
    );
    
    $body = "Here is what was sent:\n\n";
    foreach ($fields as $a => $b) {
        $body .= sprintf("%20s: %s\n\n", $b, $_REQUEST[$a]);
    }
    
    // send email
    $send = mail($to, $subject, $body, $headers);
    
    // Check if email was sent successfully
    if ($send) {
        
        $sql = "INSERT INTO contactUs (first_name, last_name, email, phone, message) VALUES ('$first_name', '$last_name', '$from', $phone, '$message')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New contact added successfully and email sent.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email sending failed.";
    }
    
    
    $conn->close();
    
    
    
    // // Google reCAPTCHA secret key
    // $secretKey = "6Le1lC8qAAAAAGdo5l3bMwzsXO3Ba8VVo8VipbhK";
    
    // // reCAPTCHA response verification
    // $captchaResponse = $_POST['g-recaptcha-response'];
    // $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
    // $responseData = json_decode($verifyResponse);
    
    // if ($responseData->success) {
    //     // CAPTCHA verified, proceed with form submission
    //     $conn = mysqli_connect("aahantechnologies.com", "raadh5xq_M3M", "4AgE[Xjw*+0F", "raadh5xq_M3M") or die('Problem in connection');
    
    //     // email details
    //     $to = "diksha@aahantechnologies.com";
    //     $from = $_POST['email'];
    //     $first_name = $_POST['first_name'];
    //     $last_name = $_POST['last_name'];
    //     $message = $_POST['message'];
    //     $headers = "From: $from";
    //     $subject = "Contact Form FindHouses Site";
    
    //     // email content
    //     $fields = array(
    //         "first_name" => "First name",
    //         "last_name" => "Last name",
    //         "email" => "Email",
    //         "message" => "Message"
    //     );
    
    //     $body = "Here is what was sent:\n\n";
    //     foreach ($fields as $a => $b) {
    //         $body .= sprintf("%20s: %s\n\n", $b, $_POST[$a]);
    //     }
    
    //     // send email
    //     $send = mail($to, $subject, $body, $headers);
    
    //     // Check if email was sent successfully
    //     if ($send) {
    //         $sql = "INSERT INTO contactUs (first_name, last_name, email, message) VALUES ('$first_name', '$last_name', '$from', '$message')";
    
    //         if ($conn->query($sql) === TRUE) {
    //             echo "New contact added successfully and email sent.";
    //         } else {
    //             echo "Error: " . $sql . "<br>" . $conn->error;
    //         }
    //     } else {
    //         echo "Email sending failed.";
    //     }
    
    //     $conn->close();
    // } else {
    //     // CAPTCHA failed
    //     echo "CAPTCHA verification failed, please try again.";
    // }

  
?>
