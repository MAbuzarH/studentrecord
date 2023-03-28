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
    $current_date = date('Y-m-d');

    // print the current date
    // echo "The current date is: " . $current_date;
?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Create</title>
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
                        <p>Admin | create</p>
                        <a class="btn btn-primary" href="http://localhost/school/student/index.php">Go Back</a>
                    </div>
                    <div>
                        <form class="row g-3" method="post">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">First name *</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter 1st name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last name *</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <div class="input-group ">
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" id="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="pnumber" class="form-label">Phone number *</label>
                                <input type="text" name="pnumber" class="form-control" id="pnumber" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
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
        if (isset($_POST['submit'])) {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $pnumber = $_POST['pnumber'];
            $email = $_POST['email'];
            $date = $current_date;
            $conn;
            $sql = "INSERT INTO `student` (`rollnumber`, `fname`, `lname`, `email`, `pnumber`, `date`) VALUES (NULL, '$fname', '$lname', '$email', '$pnumber', '$date')";
            $data = mysqli_query($conn, $sql);
            if ($data) {
                // echo "New record created successfully";
        ?>
                <script type="text/javascript">
                    alert('New record created successfully');
                    window.open('http://localhost/school/student/index.php', '-self');
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert('error');
                </script>

        <?php
                // echo "Error:".$sql."<br/>";
            }
        }
        ?>

    </body>

</html>
<?php } ?>