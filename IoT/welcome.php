<?php
    $is_opened = "";
    session_start(); // start the session
    if(!isset($_SESSION['login_user'])) { // check if user is logged in
        header("location: login.php"); // redirect to login page
        exit(); // stop further execution of the script
    }
    require 'db_connect.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hello Page</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    
    <div class="header">
        <h3>Welcome, <span id="username"><?php echo $_SESSION['login_user']; ?></span></h3>
        <div class="buttons-group">
            <a class="btn" id="control" href="control.php">Control</a>
            <a class="btn" id="logout" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="title">
        <h1>Operations History</h1>
    </div>
    <table>
        <tr>
            <th>Username</th>
            <th>Action</th>
            <th>Action time</th>
        </tr>
        <?php
            // Query the database to retrieve the username and action_time columns
            $query = "SELECT id_action, username, action_time, user_action FROM actions ORDER BY id_action DESC";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)) {
                
                if($row['user_action'] == 1){
                    $action_statement = '<b>'. $row['username']. '</b> opened the door';
                }
                if($row['user_action'] == 0){
                    $action_statement = '<b>'. $row['username']. '</b> closed the door';
                }
                if($row['user_action'] == 2){
                    $action_statement = '<b>'. $row['username']. '</b> logged in';
                }
                if($row['user_action'] == 3){
                    $action_statement = '<b>'. $row['username']. '</b> logged out';
                }
                echo "<tr><td id='username-td'>" . $row['username'] . "</td><td>" . $action_statement . "</td><td>" . $row['action_time'] . "</td></tr>";
            }
        ?>
    </table>
    <br><br>
    
    
</body>
</html>