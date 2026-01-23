<?php
echo "<h2>Demonstrating Include and Require in PHP</h2>";

// Using include
include 'included_file.php'; // If this file is missing, PHP gives a warning but continues
echo includeMessage() . "<br>";

// Using require
require 'required_file.php'; // If this file is missing, PHP gives a fatal error and stops execution
echo requireMessage() . "<br>";

echo "<p>Program executed successfully.</p>";
?>
