<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "company") or die("Connection failed: " . mysqli_connect_error());

$message = "";

// Handle form submission
if (!empty($_POST['submit'])) {
    $emp_id = $_POST['emp_id'];
    $job_title = $_POST['job_title'];
    $experience = $_POST['experience'];

    $query = "INSERT INTO employee (emp_id, job_title, experience) VALUES ('$emp_id', '$job_title', '$experience')";
    $message = mysqli_query($conn, $query) ? "Employee information inserted successfully" : "Error: " . mysqli_error($conn);
}

// Fetch all employees (ascending by experience)
$employees = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM employee ORDER BY experience ASC"), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Information Module</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin:0; padding:0; }
        h2 { text-align: center; color: #333; margin-top: 20px; }
        form, .message, table { 
            background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            margin: 20px auto; padding: 15px; max-width: 500px; text-align: center;
        }
        input[type="text"], input[type="number"], input[type="submit"] { 
            width: 95%; padding: 8px; margin: 6px 0; border-radius: 4px; border: 1px solid #ccc;
        }
        input[type="submit"] { background-color: #4CAF50; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        table { width: 80%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #4CAF50; color: white; }
        .message { color: #155724; background-color: #d4edda; font-weight: bold; }
    </style>
</head>
<body>

<h2>Employee Information Module</h2>

<!-- Employee Form -->
<form method="post">
    <h3>Enter Employee Information</h3>
    <input type="text" name="emp_id" placeholder="Employee ID" required><br>
    <input type="text" name="job_title" placeholder="Job Title" required><br>
    <input type="number" name="experience" placeholder="Years of Experience" required><br>
    <input type="submit" name="submit" value="Add Employee">
</form>

<!-- Success Message -->
<?php if ($message): ?>
    <div class="message"><?= $message ?></div>
<?php endif; ?>

<!-- Display Employee Table -->
<?php if (!empty($employees)): ?>
    <h3 style="text-align:center;">All Employees (Ascending by Experience)</h3>
    <table>
        <tr>
            <th>Employee ID</th>
            <th>Job Title</th>
            <th>Experience (Years)</th>
        </tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['emp_id'] ?></td>
            <td><?= $emp['job_title'] ?></td>
            <td><?= $emp['experience'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>