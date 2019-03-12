<?php

if ((isset($_GET["title"])) && (isset($_GET["author"])) && (isset($_GET["isbn"]))) {
    
    //session_start();

    if (!isset($_COOKIE["FredTheCookie"])) {
        print("Cookie NOT Set!");
    }

    print_r($_COOKIE);

    $book_list = unserialize($_COOKIE["FredTheCookie"]);

    array_push($book_list, array($_GET["title"], $_GET["author"], $_GET["isbn"]));

    setcookie("FredTheCookie", serialize($book_list), strtotime('+30 days'), '/');

    print_r(unserialize($_COOKIE["FredTheCookie"]));

    header("Location: ../../../../Library/Home/index.php");

    //session_destroy();

}


?>