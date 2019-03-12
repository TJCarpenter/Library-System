<?php

// Check to see if the POST method is induced

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['searchtype'] == 'key-word') {

    } else {
        $sql = 'SELECT book_title, book_author, book_isbn, book_num_copies, book_publisher, book_published_date FROM `Library`.`books` WHERE book_' . $_GET['searchtype'] . ' LIKE "%' . $_GET['search'] . '%"';
    }

    include_once('results.php');

    include_once('connect.php');
    $conn = connect();

    $result = $conn->query($sql);
    
    set_header($_GET['search'], $result->num_rows);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            results($row["book_title"], $row["book_author"], $row['book_isbn'], $row['book_num_copies'], $row['book_publisher'], $row['book_published_date']);
        }
    } else {
        echo "0 results";
    }
    $conn->close();


}



?>