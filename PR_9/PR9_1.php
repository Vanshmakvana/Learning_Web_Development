<!DOCTYPE html>
<html>
<head>
    <title>PHP Study Program</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input[type="text"],
        input[type="number"] {
            width: 95%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h3 {
            color: #555;
        }

        .output {
            background-color: #fff;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .output p, .output span {
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h2>PHP Program – User Input</h2>

<form method="post">
    Enter your name: <input type="text" name="name" required><br>
    Enter your age: <input type="number" name="age" required><br>
    Enter a number to check Even/Odd: <input type="number" name="number" required><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if(isset($_POST['submit'])) {

    // ================================
    // 1) Variables, Functions, Arrays
    // ================================
    $studentName = $_POST['name'];
    $studentAge = $_POST['age'];

    function greetStudent($name) {
        return "Hello, " . $name . "! Welcome to PHP.";
    }

    $subjects = array("Math", "Science", "English"); // numeric array
    $student = array( // associative array
        "name" => $studentName,
        "age" => $studentAge,
        "course" => "Web Development"
    );

    echo '<div class="output">';
    echo "<h3>1) Variables, Functions, and Arrays</h3>";
    echo "<span>Student Name: " . $studentName . "</span>";
    echo "<span>Student Age: " . $studentAge . "</span>";
    echo "<span>" . greetStudent($studentName) . "</span><br>";

    echo "<span>Subjects (Numeric Array):</span>";
    foreach($subjects as $subject) {
        echo "<span>- " . $subject . "</span>";
    }

    echo "<br><span>Student Details (Associative Array):</span>";
    foreach($student as $key => $value) {
        echo "<span>" . ucfirst($key) . ": " . $value . "</span>";
    }

    // ================================
    // 2) Check Even or Odd
    // ================================
    $number = $_POST['number'];
    echo "<h3>2) Check Even or Odd</h3>";
    if($number % 2 == 0) {
        echo "<span>The number $number is Even.</span>";
    } else {
        echo "<span>The number $number is Odd.</span>";
    }
    echo '</div>';
}
?>
</body>
</html>
