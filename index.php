<?php

// HTML Shell
include("./pages/all/shell.html");

//include("./pages/home/footer.html");

// Connect to the Database
include_once("./php/functions/connect.php");
$conn = connect();

// Start the session
session_start();
//$_SESSION['cardnumber'] = 1;

// Check if the user is logged in or not
if (isset($_SESSION['cardnumber'])) {
    // User is logged in
    include("./pages/home/header/header-logged-in.html");

} else {
    // User is not logged in
    include("./pages/home/header/header-not-logged-in.html");

}

// Book Search
include("./pages/home/search-bar.html");

// Book Suggestion
include("./pages/home/book-suggestions.html");


include("./pages/home/footer.html");

session_destroy();

?>