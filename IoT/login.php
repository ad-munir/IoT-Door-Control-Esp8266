<?php
session_start(); // start the session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: validate the username and password against a database

    if (empty($username) || empty($password)) {
        $error = "All fields are required";
    } else {

        require 'db_connect.php';

        // TODO: hash the password before storing it in the database for better security
        // Query the database to check the username and password
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query error: ' . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {

            $query = "INSERT INTO actions (username, `action_time`, user_action) VALUES ('$username', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), 2)";
            mysqli_query($conn, $query);

            $_SESSION['login_user'] = $username;
            header("location: welcome.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h2>Login Page</h2>

    <div class="login-page">
        <div class="form">
            <form method="post" class="login-form">
                <input type="text" id="username" name="username" placeholder="username">
                <input type="password" id="password" name="password" placeholder="password">

                <button type="submit">Login</button>
            </form>
            <?php
                    if (isset($error)) {
                        echo "<div style='color:red;font-weight:bold;margin-top:25px;'>" . $error . "</div>";
                    }
                ?>
        </div>
    </div>

</body>

</html>