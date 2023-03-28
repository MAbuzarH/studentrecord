<?php
$servername = 'localhost';
$username = 'root';
$pasword = '';
$dbname = 'school';

$conn = new mysqli($servername,$username,$pasword,$dbname);

if($conn->connect_error){
    die("connect error".$conn->connect_error);
}
else{
    echo "Connected successfully";
}

?>
