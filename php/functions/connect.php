<?php
function connect() {
    // Connect to the Database using the INI file in ./db

    // Collect the information from the INI
    $ini_array = parse_ini_file("C:\Coding Folder\Web Dev\Library System\db\db.ini");

    // Create Connection
    $conn = new mysqli($ini_array['servername'], $ini_array['username'], $ini_array['password']);

    // Test the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo '<script>console.log("Connection Successful")</script>';

    return $conn;
}
?>