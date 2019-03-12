<?php

//todo Check to see if the POST method is induced
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //! Connect to the DB
    //? Include the connection function
    include_once('./connect.php');

    //? Set the connection variable
    $conn = connect();
    
    //! Prepare the Bind Statement
    $stmt = $conn->prepare("INSERT INTO `library`.`staff` (
        staff_badge_number,
        staff_first_name,
        staff_last_name,
        staff_birth_date,
        staff_gender,
        staff_street,
        staff_city,
        staff_state,
        staff_zip,
        staff_phone_number,
        staff_email,
        staff_job_title,
        staff_pay_style,
        staff_wage,
        staff_max_hours,
        staff_annual_salary,
        staff_admin_access,
        staff_record_access,
        staff_book_access,
        staff_record_edit_access,
        staff_book_edit_access
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("issssssssssssdddiiiii",
        $badge_number,
        $first_name,
        $last_name,
        $birthdate,
        $gender,
        $street,
        $city,
        $state,
        $zip,
        $phone_number,
        $email,
        $job_title,
        $pay_style,
        $wage,
        $max_hours,
        $annual_salary,
        $admin_access,
        $record_access,
        $book_access,
        $record_edit_access,
        $book_edit_access
    );

    //! Collect the variables from the form
    $badge_number =     $_POST['badge_number'];     // int(15)
    $first_name =       $_POST['first_name'];       // varchar(255)
    $last_name =        $_POST['last_name'];        // varchar(255)
    $birthdate =        $_POST['birthdate'];        // date (yyyy-mm-dd)
    $gender =           $_POST['gender'];           // varchar(6)
    $street =           $_POST['street'];           // varchar(255)
    $city =             $_POST['city'];             // varchar(255)
    $state =            $_POST['state'];            // varchar(2)
    $zip =              $_POST['zipcode'];          // varchar(10)
    $phone_number =     $_POST['phone_number'];     // int(10)
    $email =            $_POST['email'];            // varchar(255)
    $job_title =        $_POST['job_title'];        // varchar(255)
    $pay_style =        $_POST['pay_style'];        // varchar(6)
    $wage =             $_POST['wage'];             // double(6)
    $max_hours =        $_POST['max_hours'];        // double(4)
    $annual_salary =    $_POST['annual_salary'];    // double(7)

    //! Set the access levels based on the Job Title
    switch($job_title) {
        case "manager":
            // Read
            $admin_access = "1";
            $record_access = 1;
            $book_access = 1;

            // Write
            $record_edit_access = 1;
            $book_edit_access = 1;
            break;
        case "library-director":
            // Read
            $admin_access = 0;
            $record_access = 1;
            $book_access = 1;

            // Write
            $record_edit_access = 1;
            $book_edit_access = 1;
            break;

        case "librarian":
            // Read
            $admin_access = 0;
            $record_access = 1;
            $book_access = 1;

            // Write
            $record_edit_access = 0;
            $book_edit_access = 1;
            break;

        case "librarian-assistant":
            // Read
            $admin_access = 0;
            $record_access = 0;
            $book_access = 1;

            // Write
            $record_edit_access = 0;
            $book_edit_access = 1;
            break;
    }

    //! Execute the statement
    $stmt->execute();

    if (!$stmt) {
        echo "<script>console.log(". PDO::errorInfo() . ")</script>";
        print_r($dbh->errorInfo());
    } else {
        echo "<script>console.log('1 Row Inserted')</script>";
    }

    $stmt->close();
    $conn->close();

}



?>