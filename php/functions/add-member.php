<?php

//todo Check to see if the POST method is induced
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //! Connect to the DB
    //? Include the connection function
    include_once('./connect.php');

    //? Set the connection variable
    $conn = connect();
    
    //! Prepare the Bind Statement
    $stmt = $conn->prepare("INSERT INTO `library`.`member` (
        member_card_number,
        member_pin,
        member_first_name,
        member_last_name,
        member_birth_date,
        member_street,
        member_city,
        member_state,
        member_zip,
        member_phone_number,
        member_email
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("iisssssssss",
        $card_number,
        $pin,
        $first_name,
        $last_name,
        $birthdate,
        $street,
        $city,
        $state,
        $zip,
        $phone_number,
        $email
    );   

    //! Collect the variables from the form
    $card_number =      $_POST['member_card_number'];               // int(15)
    $pin =              $_POST['member_pin'];                       // int(4)
    $first_name =       $_POST['member_first_name'];                // varchar(255)
    $last_name =        $_POST['member_last_name'];                 // varchar(255)
    $birthdate =        $_POST['member_birthdate'];                 // date (yyyy-mm-dd)
    $street =           $_POST['member_street'];                    // varchar(255)
    $city =             $_POST['member_city'];                      // varchar(255)
    $state =            $_POST['member_state'];                     // varchar(2)
    $zip =              $_POST['member_zipcode'];                   // varchar(10)
    $phone_number =     $_POST['member_phone_number'];              // int(10)
    $email =            $_POST['member_email'];                     // varchar(255)

    //! Execute the statement
    $stmt->execute();

    if (!$stmt) {
        echo PDO::errorInfo();
        print_r($dbh->errorInfo());
    } else {
        echo "<script>console.log('1 Row Inserted')</script>";
    }

    $stmt->close();
    $conn->close();

    header("Location: {$_SERVER["HTTP_REFERER"]}");

}



?>