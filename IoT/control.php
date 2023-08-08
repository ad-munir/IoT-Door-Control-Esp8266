<?php
session_start();
if(!isset($_SESSION['login_user'])) { // check if user is logged in
    header("location: login.php"); // redirect to login page
    exit(); // stop further execution of the script
}
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['is_opened'])) {
        if ($_POST['is_opened'] == "open") {
            $new_value = 1;
            //$sql = "UPDATE openings SET action = 1 WHERE username = echo ".$_SESSION['login_user'] . "AND openings.is_open = door.is_open";
        } else {
            $new_value = 0;
        }
    }
    $sql = "UPDATE door SET is_open='$new_value'";
    mysqli_query($conn, $sql);

    $sqlAction = "INSERT INTO actions (username, `action_time`, user_action) VALUES ('".$_SESSION['login_user']."', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), '$new_value') ";
    //$sqlAction = "UPDATE openings SET action = '$new_value' WHERE username = '".$_SESSION['login_user']."'";
    mysqli_query($conn, $sqlAction);
}

$door_status;
$open_btn_disabled= "";
$close_btn_disabled= "";

$query = "SELECT is_open FROM door LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Retrieve the first row of data
    $row = mysqli_fetch_assoc($result);

    if ($row["is_open"] == 1) {
        $door_status = "<h3>Door is Open </h3>";
        $open_btn_disabled= "disabled";

    } else {
        $close_btn_disabled= "disabled";
        $door_status = "<h3>Door is Closed </h3>";
    }
} else {
    echo "No data found.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Door Control</title>
    <link rel="stylesheet" href="control.css">
</head>

<body>
    <div class="header">
        <h3>Welcome, <span id="username"><?php echo $_SESSION['login_user']; ?></span></h3>
        <div class="buttons-group">
            <a class="btn" id="control" href="welcome.php">Home</a>
            <a class="btn" id="logout" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="title">
        <h1>Door Control</h1>
    </div>
    
    <form action="" class="door-control-form" method="post">
        <?php echo $door_status; ?>
        <input class="open-btn"  type="submit" value="open" name="is_opened"  <?php echo $open_btn_disabled ?>>
        <input class="close-btn" type="submit" value="close" name="is_opened" <?php echo $close_btn_disabled ?>>
    </form>
</body>

</html>