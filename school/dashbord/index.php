<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== true) {
    // Redirect to login page
    header("Location: http://localhost/school/login/index.php");
    exit;
} else {
    include("connection.php");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include("head.php");
        ?>
        <title>DASHBORD</title>
    </head>

    <body>
        <div class="d-flex row">
            <div class="nav-bar text-center col-3 vh-100" >
                <nav class="nav bg-dark flex-column vh-100" >
                    <p class="text-primary">LMS</p>
                    <hr class="h-40 text-primary">
                    <a class="nav-link active" aria-current="page" href="http://localhost/school/dashbord/">DASHBORD</a>
                    <a class="nav-link" href="http://localhost/school/student/index.php">Student</a>
                </nav>
            </div>
            <div class="main col-9">
                <div class="navebar2" >
                    <nav class="navbar bg-light" >
                        <div class="container-fluid">
                            <span class="navbar-brand mb-0 p-3">Navbar</span>
                        </div>
                        <hr class="h-40 text-primary">
                    </nav>
                </div>
                <div class="cardsp bg-success p-4 h-75" >
                    <div class="card m-2 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Student</h5>
                            <p class="card-text">
                                <?php
                                $count = 'SELECT COUNT(*) AS total_count FROM student';
                                $result = mysqli_query($conn, $count);
                                // fetch the result as an array
                                $row = $result->fetch_assoc();

                                // get the total count
                                $total_count = $row['total_count'];

                                // display the total count
                                echo $total_count;
                                ?>

                            </p>
                        </div>
                    </div>
                    <div class="card m-2 text-center">
                        <div class="card-body">
                            <h5 class="card-title">New Student (7 days)</h5>
                            <p class="card-text">
                                <?php
                                // $newS = "SELECT COUNT(*) AS seven FROM student WHERE 'date' >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
                                // $resultOfn = mysqli_query($conn, $newS);
                                // $row1 = mysqli_fetch_array($resultOfn);
                                // $res = $row1['seven'];
                                // echo $res;
                                $newr = "SELECT *  FROM student";
                                $result1 = $conn->query($newr);
                                if ($result1->num_rows > 0) {

                                    // Create an array to store the dates from the database
                                    $dates = array();
                                    // echo "2";
                                    // Loop through each row and add the date to the array
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $dates[] = $row1['date'];
                                        // echo "2";
                                    }
                                    // var_dump($row['date']);
                                    // var_dump($dates);
                                    // Compare each date with the current date
                                    $count1 = 0;

                                    foreach ($dates as $date) {
                                        if (date("Y-m-d", strtotime($date)) <= date("Y-m-d", strtotime('-7 days'))) {
                                            $count1++;

                                            // echo "The date " . date("Y-m-d", strtotime('-7 days')) . " is the same as the current date<br>";
                                        }
                                        // echo $date;
                                    }
                                } else {
                                    echo "No results found.";
                                }
                                echo $total_count - $count1;
                                ?>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="bg-light text-center p-3" >
                    <p>copyright abuzar 2022</p>
                </div>
            </div>


        </div>

    </body>

    </html>
<?php
}
?>
