<?php
$host = 'localhost';
$user = 'root';
$pwd = '';
$db = 'database_nsbm';

// Create connection
$con = mysqli_connect($host, $user, $pwd, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "";
}
?>
