<?php

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    $conn = mysqli_connect("localhost","root","","Project") or die('problem in connection');
    

    // to check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //die ("Connection error: " . mysqli_connect_error());
    }
   
?>