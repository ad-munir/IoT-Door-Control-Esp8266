<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "id20789213_iot_project";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    // Check if the database connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>