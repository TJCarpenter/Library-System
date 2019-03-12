<?php
    //! Initial PHP

?>



<?php

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

    // Search Results

    // Check to see if the GET method is induced
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if ($_GET['searchtype'] == 'key-word') {

        } else {
            $sql = 'SELECT book_title, book_author, book_isbn, book_num_copies, book_publisher, book_published_date FROM `Library`.`books` WHERE book_' . $_GET['searchtype'] . ' LIKE "%' . $_GET['search'] . '%"';
        }

        // Connect to the Data Base
        include_once('../../php/functions/connect.php');
        $conn = connect();

        // Set the results
        $result = $conn->query($sql);
        
        // Set the search details
        $search = $_GET['search'];
        $num_results = $result->num_rows;

        ?>

    <!-- Search Details -->

    <div class="search px-5">
        <div class="container">

            <ul class="list-inline">
                <li class="list-inline-item">
                    <h3 class="my-5">Searching for</h3>
                </li>
                <li class="list-inline-item">
                    <h3 class="my-5"><strong>
                            <?php echo $search; ?></strong></h3>
                </li> <!-- Add PHP Here -->
                <li class="list-inline-item">
                    <h3 class="my-5"><small><em>
                                <?php if ($num_results > 0) { echo $num_results; } else { echo 'None'; } ?> Results Found</em></small></h3>
                </li> <!-- Add PHP Here -->
            </ul>

            <hr class="mx-3">

            <div class="col p-3">


        <?php

        if ($num_results > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        ?>

    <div class="row my-3" id="book-search">
        <div class="col-sm d-flex justify-content-center" id="book-display-1-img">
            <img class="mx-10" src="../../../src/img/placeholder/suggestion/suggestion_128.png" alt="logo" width="128"
                height="128">
        </div>
        <div class="col-sm-8 pl-0" id="book-display-1-desc">
            <div class="row">
                <ul class="list-unstyled">
                    <li>
                        <h5 class="pt-3" id="book-title">
                            <a href="#" data-toggle="modal" data-target="#<?php echo str_replace("'", '', str_replace(' ', '-', $row["book_title"]));?>-modal">
                                <strong>
                                    <?php echo $row["book_title"]; ?></strong>
                                <br>
                                <em>
                                    <?php echo $row["book_author"]?></em>
                            </a>
                        </h5>
                    </li>
                    <li>
                        <p id="book-desc">Lorem ipsum delor sit amet consecture adiposing slit sed do
                            euismod tempor</p>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-sm p-0">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6 class="">ISBN: </h6>
                        </li>
                        <li class="list-inline-item">
                            <h6 class="">
                                <?php echo $row['book_isbn']; ?>
                            </h6> <!-- Add PHP Here -->
                        </li>
                    </ul>
                </div>
                <div class="col-sm p-0">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6 class="">Status: </h6>
                        </li>
                        <li class="list-inline-item">
                            <h6 class="">
                                <?php if($row['book_num_copies'] > 0) { echo '<p style="color: green">Avaliable</p>'; } else { echo '<p style="color: red">Not Avaliable</p>'; }?>
                            </h6> <!-- Add PHP Here -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="<?php echo str_replace("'", '', str_replace(' ', '-', $row["book_title"]));?>-modal"
        aria-hidden="true" id="<?php echo str_replace("'", '', str_replace(' ', '-', $row["book_title"]));?>-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h6 class="mb-0">Details for
                        <?php echo "<strong>  " . $row["book_title"] . "</strong>"; ?>
                    </h6>

                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col d-flex align-items-center justify-content-center">
                            <img class="mx-10" src="../../../src/img/placeholder/suggestion/suggestion_128.png" alt="logo"
                                width="128" height="128">
                        </div>
                        <div class="col">
                            <p><strong>Title: </strong>
                                <?php echo $row["book_title"] ?>
                            </p>
                            <p><strong>Author: </strong>
                                <?php echo $row["book_author"] ?>
                            </p>
                            <p><strong>ISBN: </strong>
                                <?php echo $row['book_isbn'] ?>
                            </p>
                            <p><strong>Publisher: </strong>
                                <?php echo $row['book_publisher'] ?>
                            </p>
                            <p><strong>Published: </strong>
                                <?php echo $row['book_published_date'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">

                    <!-- Add book to my books -->
                    <form action="../functions/add_to_my_books.php" method="GET">
                        <button type="submit" class="btn btn-secondary" <?php if ($row['book_num_copies']==0) { echo 'disabled' ; }?>>Add
                            to My Books</button>
                    </form>

                    <!-- Check book out -->
                    <form action="">
                        <button type="submit" class="btn btn-primary" <?php if ($row['book_num_copies']==0) { echo 'disabled' ; }?>>Check
                            Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        
        <?php
        
            }
        } else {
            echo "0 results";
        }

        $conn->close();

}



?>