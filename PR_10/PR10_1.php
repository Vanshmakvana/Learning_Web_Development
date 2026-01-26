<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "college") or die("Connection failed: " . mysqli_connect_error());

$message = "";
$resultData = [];

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $enrollment = $_POST['enrollment'] ?? '';
    $name = $_POST['name'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $percentage = $_POST['percentage'] ?? '';

    switch ($action) {
        case "Insert":
            $query = "INSERT INTO student (enrollment, name, semester, percentage) VALUES ('$enrollment','$name','$semester','$percentage')";
            $message = mysqli_query($conn, $query) ? "New student's information inserted successfully" : "Error inserting data";
            break;

        case "Update":
            $query = "UPDATE student SET name='$name', semester='$semester', percentage='$percentage' WHERE enrollment='$enrollment'";
            $message = mysqli_query($conn, $query) ? "Student's information updated successfully" : "Error updating data";
            break;

        case "Delete":
            $query = "DELETE FROM student WHERE enrollment='$enrollment'";
            $message = mysqli_query($conn, $query) ? "Student's information deleted successfully" : "Error deleting data";
            break;

        case "Show All Students":
            $res = mysqli_query($conn, "SELECT * FROM student");
            $resultData = mysqli_fetch_all($res, MYSQLI_ASSOC);
            break;
    }

    // Search by enrollment (handled separately)
    if (isset($_POST['search'])) {
        $searchEnroll = $_POST['search_enrollment'];
        $res = mysqli_query($conn, "SELECT * FROM student WHERE enrollment='$searchEnroll'");
        $resultData = mysqli_fetch_all($res, MYSQLI_ASSOC);
        if (empty($resultData)) $message = "Wrong enrollment number entered, please try again";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Database Application</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin:0; padding:0; }
        h2 { text-align: center; margin: 20px; color: #333; }
        form { max-width: 600px; margin: 20px auto; padding: 15px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="number"], input[type="submit"] { padding: 8px; margin: 5px 0; width: 95%; border-radius: 4px; border: 1px solid #ccc; }
        input[type="submit"] { width: 30%; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        .search-form, .message { max-width: 400px; margin: 20px auto; padding: 10px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); text-align:center; }
        .message { color: green; font-weight: bold; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Student Database Application</h2>

<!-- Student CRUD Form -->
<form method="post">
    <h3>Insert / Update / Delete Student</h3>
    <input type="text" name="enrollment" placeholder="Enrollment No." required><br>
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="number" name="semester" placeholder="Semester" required><br>
    <input type="number" step="0.01" name="percentage" placeholder="Percentage" required><br>
    <input type="submit" name="action" value="Insert">
    <input type="submit" name="action" value="Update">
    <input type="submit" name="action" value="Delete">
</form>

<!-- Search & Show All -->
<form method="post" class="search-form">
    <h3>Search Student</h3>
    <input type="text" name="search_enrollment" placeholder="Enter Enrollment No." required>
    <input type="submit" name="search" value="Search">
</form>

<form method="post" class="search-form">
    <input type="submit" name="action" value="Show All Students">
</form>

<!-- Messages -->
<?php if($message != ""): ?>
    <div class="message <?= empty($resultData) ? 'error' : '' ?>"><?= $message ?></div>
<?php endif; ?>

<!-- Display Results -->
<?php if(!empty($resultData)): ?>
    <h3 style="text-align:center;">Student Information</h3>
    <table>
        <tr>
            <th>Enrollment</th>
            <th>Name</th>
            <th>Semester</th>
            <th>Percentage</th>
        </tr>
        <?php foreach($resultData as $stu): ?>
        <tr>
            <td><?= $stu['enrollment'] ?></td>
            <td><?= $stu['name'] ?></td>
            <td><?= $stu['semester'] ?></td>
            <td><?= $stu['percentage'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>