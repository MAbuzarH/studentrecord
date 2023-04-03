<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>

<body  class="bg-light">
  
    <center>
        <h1 class="p-3">LOG IN</h1>
    </center>

    <div class="d-flex justify-content-center p-4">

        <form method="post" class="bg-secondary border border-primary p-5">
            <div class="row mb-4">
                <label for="name" class="col-sm-3 col-form-label">name</label>
                <div class="col-sm-9">
                    <input type="text" name="name"  id="name">
                </div>
            </div>
            <div class="row mb-4">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" name="email"  id="email">
                </div>
            </div>
            <div class="row mb-4">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" name="password"  id="password">
                </div>
            </div>
            <center>
                <button type="submit" name="submit" class="btn btn-primary">LOG IN</button>
                <center>
        </form>
    </div>
</body>

</html>
<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {


    // Get form input
    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
//     echo $username, $password, $email;
    $sql = "SELECT * FROM login WHERE fname='$username' AND email= '$email' AND pasword='$password' ";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($result) === 1) {
        // Start session and redirect to dashboard

        $_SESSION['fname'] = $username;
        $_SESSION['submit'] = true;
        header("Location: http://localhost/school/dashbord/index.php");
        exit;
    } else {
        // Login failed, redirect to login with error message
        header("Location: lndex.php?error=1");
        echo "error";
        exit;
    }
}
?>
