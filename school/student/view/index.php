<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== true) {
    // Redirect to login page
    header("Location: http://localhost/school/login/index.php");
    exit;
} else {
    require_once("../../dashbord/connection.php");
    include("../../dashbord/head.php");
    // get the current date


    // print the current date
    // echo "The current date is: " . $current_date;
    $id = $_GET['id'];

    global $conn;
    $result = "SELECT * FROM student WHERE rollnumber = '$id'";
    $data = mysqli_query($conn, $result);
    $row = mysqli_fetch_array($data);
    $sql = "SELECT rollnumber FROM student";
    $result1 = mysqli_query($conn, $sql);

    $map = false;
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $ids = $row1['rollnumber'];
        if ($data and $ids == $id) {
            $map = true;
        }
    }
    if ($map) {
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">


            <title>view</title>
        </head>

        <body>
            <div style="display:flex; ">
                <div class="nav-bar" style="height: 100vh; flex:10%; text-align: center; width:20%; display: inline-block;">
                    <nav class="nav bg-dark flex-column" style="height: 100vh;">
                        <p style="color:aliceblue;">LMS</p>
                        <hr style="height:2px; color: aliceblue; ">
                        <a class="nav-link active" aria-current="page" href="http://localhost/school/dashbord/">DASHBORD</a>
                        <a class="nav-link" href="http://localhost/school/student/index.php">Student</a>
                    </nav>
                </div>
                <div class="main" style="flex:60%; flex-direction: column;">
                    <div class="navebar2" style="height:15%">
                        <nav class="navbar bg-light" style="height:100%">
                            <div class="container-fluid">
                                <span class="navbar-brand mb-0 h1">Navbar</span>
                            </div>
                            <hr style="height:2px; color: aliceblue; ">
                        </nav>
                    </div>
                    <div class="cardsp bg-success p-4 " style="height: 70%;">
                        <div style="display: flex; justify-content:space-between;" class="p-1">
                            <p>Admin | Edit</p>
                            <a class="btn btn-primary" href="http://localhost/school/student/index.php">Go Back</a>
                        </div>
                        <div>
                            <form class="row g-3" method="post">
                                <div class="col-md-6">
                                    <label for="firstname" class="form-label">First name *</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $row['fname']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname" class="form-label">Last name *</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $row['lname']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <div class="input-group ">
                                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" id="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="pnumber" class="form-label">Phone number *</label>
                                    <input type="text" name="pnumber" value="<?php echo $row['pnumber']; ?>" class="form-control" id="pnumber" required>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-primary" type="edit" name="edit" href="../edit/index.php?id=<?php echo $id ?>">Edit</a>

                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="bg-light text-center " style="height:10%">
                        <p>copyright abuzar 2022</p>
                    </div>
                </div>


            </div>
        <?php
    } else {
        ?>
            <script>
                alert('error', );
                window.open('http://localhost/school/student/index.php', '_self');
            </script>
        <?php

    }
        ?>
        </body>

</html>
<?php } ?>