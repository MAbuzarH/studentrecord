<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== true) {
    // Redirect to login page
    header("Location: http://localhost/school/login/index.php");
    exit;
} else {
    require_once("../../dashbord/connection.php");
    global $conn;
    $id = $_GET['id'];
    $sql = "SELECT rollnumber FROM student";
    $result = mysqli_query($conn, $sql);

    $query = "DELETE  FROM student WHERE rollnumber = $id";
    $data = mysqli_query($conn, $query);
    $map = false;
    while ($row = mysqli_fetch_assoc($result)) {
        $ids = $row['rollnumber'];
        if ($data and $ids == $id) {
            $map = true;
        }
    }
    if ($map) {
?>
        <script>
            alert("data deleted successfully");
            window.open('http://localhost/school/student/index.php', '_self');
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("data not deleted successfully");
        </script>


<?php }
}
?>