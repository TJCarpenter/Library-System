<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Look up the member to determine if they are a member
    $cardnumber = $_POST["cardnumber"];
    $pin = $_POST["pin"];

    // Connect to the database
    include("./connect.php");
    $conn = connect();

    // Prepare the SQL Statement
    $stmt = $conn->prepare("SELECT * FROM `library`.`member` WHERE member_card_number = ? AND member_pin = ?");
    $stmt_card = $conn->prepare("SELECT * FROM `library`.`member` WHERE member_card_number = ?");
    
    // Bind the parameters to the statement
    $stmt->bind_param("ii", $cardnumber, $pin);
    $stmt_card->bind_param("i", $cardnumber);

    //! Execute the statement and store the result
    $stmt->execute();
    $stmt->store_result();

    $stmt_card->execute();
    $stmt_card->store_result();

    if ($stmt->num_rows == 1) {
        // User is found
        echo "User Found!";
        
        // Start the session
        session_start();

        // Set session variables
        $_SESSION['cardnumber'] = $_POST["cardnumber"];
        
        // Check if the book list is already set
        if (!isset($book_list)) {

            // Create an empty list to store the books in
            $book_list = [];

        }

        // Set cookie variables
        setcookie("FredTheCookie", serialize($book_list), strtotime('+30 days'), '/');

        // Return to the home page
        header("Location: ../../../../Library/Home/index.php");


    } else if($stmt->num_rows > 1) {
        // More than one user found
        echo "Multiple Users Found";

    } else if(($stmt_card->num_rows == 1) && ($stmt->num_rows == 0)){
        // Incorrect PIN
        echo "Incorrect PIN";
        
    } else {
        // User not found
        echo "Incorrect Card Number or PIN";
    }

    $stmt->close();
    $conn->close();


}

?>