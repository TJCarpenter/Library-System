<?php

    //session_destroy();

    //! Initial PHP

    // Check if the session is valid
    if (session_status() != PHP_SESSION_NONE) {

        //? Redirect to the home page
        header("../../../Library/Home/index.php");

    }


?>

<!-- Header -->
<div class="header">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navbar Logo -->
        <div class="row w-100 m-0">
            <div class="col">
                <a href="#" class="navbar-brand" style="position: relative; z-index: 2">
                    <img src="../../../src/img/logo/logo_128.png" alt="logo" width="32" height="32">
                    Deving County Public Library
                </a>
            </div>

            <div class="col float-right">
                <div class="navbar">
                    <div class="btn-group ml-auto">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            My Books
                        </button>
                        <form class="dropdown-menu p-4 dropdown-menu-right" style="width: 15rem">
                            <h4 class="text-center">My Books</h4>

                            <hr class="my-2">

<?php


print_r($_COOKIE);

if (empty(unserialize($_COOKIE['FredTheCookie']))) {

    // Book list is empty and should display an empty message

?>
                            <h4 class="text-center my-4 "><small>No books</small></h4>   
                            
<?php

} else {

    foreach(unserialize($_COOKIE['FredTheCookie']) as list($book_title, $isbn, $author)) {


?>
                            <div class="row p-1" id="my-books">
                                <div class="col" id="book-img">
                                    <img src="../../../src/img/placeholder/suggestion/suggestion_64.png" alt="book">
                                </div>
                                <div class="col text-center d-flex align-items-center" id="book-title">
                                    <div>
                                        <h6><?php echo $book_title; ?></h6>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-2">                          

<?php

    }
}

?>


                            <button class="btn btn-secondary btn-block" type="buton">Check Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</div>