<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "school";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
