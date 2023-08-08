<?php
    session_start();
    require 'db_connect.php';


    $username = $_SESSION['login_user'];
    $query = "INSERT INTO actions (username, `action_time`, user_action) VALUES ('$username', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), 3)";
    mysqli_query($conn, $query);


    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect the user to a different page
    header("Location: login.php");
    exit();
?>