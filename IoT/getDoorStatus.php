<?php
// Connect to the database
$servername = "localhost";
$username = "id20789213_munir";
$password = "E6kh@Ch]4xlxw@hx";
$dbname = "id20789213_iot_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select a row from the database
$sql = "SELECT is_open FROM door LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $value = $row["is_open"];

    echo "$value"; // Send the values as a response
} else {
    echo "No data found";
}

$conn->close();
