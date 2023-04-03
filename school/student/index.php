<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== true) {
    // Redirect to login page
    header("Location: http://localhost/school/login/index.php");
    exit;
} else {
    require_once("../dashbord/connection.php");
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limi = 3;
    $offset = ($currentPage - 1) * $limi;
    $query = "SELECT * FROM student  LIMIT   {$offset},  {$limi}";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Student</title>

    </head>


    <body>
        <div class="d-flex row">
        <div class="nav-bar text-center col-3 vh-100">
                <nav class="nav bg-dark flex-column vh-100">
                    <p class="text-primary">LMS</p>
                    <hr class="h-40 text-primary">
                    <a class="nav-link active" aria-current="page" href="http://localhost/school/dashbord/index.php">DASHBORD</a>
                    <a class="nav-link" href="http://localhost/school/student/index.php">Student</a>
                </nav>
            </div>
            <div class="main col-9" >
                <div class="navebar2 " >
                    <nav class="navbar bg-light vh-100" >
                        <div class="container-fluid">
                            <span class="navbar-brand mb-0 p-3">Navbar</span>
                        </div>
                      <hr class="h-40 text-primary">
                    </nav>
                </div>
                <div class="cardsp bg-success p-4 h-75" >
                    <div class="p-1 d-flex justify-between ">
                        <p>Admin</p>
                        <form class="d-flex" method="post">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-info" type="search">Search</button>
                        </form>

                        <a class="btn btn-primary" href="creat/index.php">Add student</a>
                    </div>
                    <table class="table text-center table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Roll Number</th>
                                <th scope="col">fName</th>
                                <th scope="col">lName</th>
                                <th scope="col">email</th>
                                <th scope="col">Phon Number</th>

                                <th scope="col">view</th>
                                <th scope="col"> Edit</th>
                                <th scope="col"> Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                if (!empty(isset($_POST['search']))) {
                                    $searchTerm = $_POST['search'];
                                    // Execute the search query
                                    $sql = "SELECT * FROM student WHERE fname LIKE '%$searchTerm%'  LIMIT   {$offset},  {$limi}";
                                    $searchresult = mysqli_query($conn, $sql);

                                    $searchresult = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($searchresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($searchresult)) {
                                ?>
                                            <td> <?php echo $row['rollnumber']; ?> </td>
                                            <td> <?php echo $row['fname']; ?> </td>
                                            <td> <?php echo $row['lname']; ?> </td>
                                            <td> <?php echo $row['email']; ?> </td>
                                            <td> <?php echo $row['pnumber']; ?> </td>
                                            <td> <a href="view/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-info" type="view" name="view" id="view">view</a> </td>
                                            <td> <a href="edit/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-primary" type="edit" name="edit" id="edit">Edit</a> </td>
                                            <td> <a href="update.php?id=<?php echo $row['rollnumber']; ?>" type="update" name="update" id="update" class="btn btn-primary">Update</a> </td>
                                            <td> <a onclick="return confirm('Are you sure to delete this?')" href=" delete/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-danger">Delete</a> </td>
                            </tr>
                    <?php }
                                    } else {
                                        echo "no result founfd";
                                    }
                                } else {
                    ?>
                    <tr>
                        <?php



                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <td> <?php echo $row['rollnumber']; ?> </td>
                            <td> <?php echo $row['fname']; ?> </td>
                            <td> <?php echo $row['lname']; ?> </td>
                            <td> <?php echo $row['email']; ?> </td>
                            <td> <?php echo $row['pnumber']; ?> </td>
                            <td> <a href="view/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-info" type="view" name="view" id="view">view</a> </td>
                            <td> <a href="edit/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-primary" type="edit" name="edit" id="edit">Edit</a> </td>
                            <td> <a href="update.php?id=<?php echo $row['rollnumber']; ?>" type="update" name="update" id="update" class="btn btn-primary">Update</a> </td>
                            <td> <a onclick="return confirm('Are you sure to delete this?')" href=" delete/index.php?id=<?php echo $row['rollnumber']; ?>" class="btn btn-danger">Delete</a> </td>
                    </tr>
            <?php
                                    }
                                }

            ?>
                        </tbody>
                    </table>
                    <?php

                    $sqli1 = 'SELECT * FROM student';

                    $result1 = mysqli_query($conn, $sqli1) or die("Error");

                    if (mysqli_num_rows($result1) > 0) {

                        $totalrecords = mysqli_num_rows($result1);

                        $total_pages = ceil($totalrecords / $limi); ?>
                        <div>
                            <style>
                                .active {
                                    text-decoration: none;
                                    background-color: aquamarine;
                                }
                            </style>
                            <ul class="d-flex justify-content-end gap-1 " style="list-style: none">
                                <?php

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $active = $i == $currentPage ? "active" : "";
                                ?>
                                    <li class="btn btn-info <?php $active ?>"> <a href="index.php?page=<?php echo $i;  ?>"><?php echo $i;  ?></a></li>
                            <?php
                                }
                            }
                            ?>

                            </ul>
                        </div>

                </div>
                <div class="bg-light text-center p-3" >
                    <p>copyright abuzar 2022</p>
                </div>
            </div>


        </div>
        <!-- code for searchbar -->

    </body>

    </html>
<?php } ?>
