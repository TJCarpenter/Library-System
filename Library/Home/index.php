<!-- Home Page -->
<!-- Path: ./ -->

<?php
    //! Initial PHP
    session_start();
    

    // Check if the users cardnumber is set with the session
    if (!isset($_SESSION['cardnumber'])) {

        //? Session invalid, destroy the created session
        session_destroy();

    }

?>

<?php
    //! Includes
    
    // HTML Shell
    include($_SERVER["DOCUMENT_ROOT"] . "/pages/all/shell.html"); // Includes all Bootstrap and heading tags

    // Header
    if (session_status() == PHP_SESSION_NONE) {
        //? Session has not been started

        // Header with Login Handler
        include($_SERVER["DOCUMENT_ROOT"] . "/pages/home/header/header-not-logged-in.php");


    } else {
        //? Session has been started

        // Header that contains users books
        include($_SERVER["DOCUMENT_ROOT"] . "/pages/home/header/header-logged-in.php");

    }

    // Search Bar
    include($_SERVER["DOCUMENT_ROOT"] . "/pages/home/search-bar.php");

    // Featured Books
    include($_SERVER["DOCUMENT_ROOT"] . "/pages/home/book-suggestions.php");

    // Footer
    include($_SERVER["DOCUMENT_ROOT"] . "/pages/home/footer.php")

?>