<?php
    //! Initial PHP

    // TODO Get the 3 most recently published book
    
    // Connect to the Database
    include($_SERVER["DOCUMENT_ROOT"] . "/php/functions/connect.php");
    $conn = connect();

    // Prepare the query
    $sql = "SELECT book_title, book_author FROM `library`.`books` WHERE 1=1 ORDER BY book_published_date DESC LIMIT 3";

    // Store the results
    $result = $conn->query($sql);

    // Set the index
    $index = $result->num_rows;

    // Print the header


    while($row = $result->fetch_assoc()) {

        add_to_featured($row["book_title"], $row["book_author"], $index--);
    }

    $conn->close();

?>

<?php function add_to_featured($book_title, $book_author, $index) { ?>


<?php if($index === 3) { ?>
<!-- Book Suggestions -->
<div class="suggestions p-5">
    <div id="book-suggestions" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
<?php } ?>
            <!-- Carousel Item -->
            <div class="carousel-item <?php if($index === 3) { echo 'active'; } ?>">

                <div class="row my-3" id="book-search">

                    <div class="col-sm d-flex justify-content-center" id="book-display-<?php echo $index; ?>-img">
                        <img class="mx-10" src="../../src/img/placeholder/suggestion/suggestion_128.png" alt="logo" width="128"
                            height="128">
                    </div>

                    <div class="col-sm-8 pl-0" id="book-display-<?php echo $index; ?>-desc">
                        <div class="row">
                            <ul class="list-unstyled">
                                
                                <!-- Book Title -->
                                <li>
                                    <h5 class="pt-3" id="book-title"><?php echo "<strong>" . $book_title . "</strong>" . " | " . "<em>" . $book_author . "</em>"; ?></h5>
                                </li>

                                <!-- Book Description -->
                                <li>
                                    <p id="book-desc">Lorem ipsum delor sit amet consecture adiposing slit sed do
                                        euismod tempor</p>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
<?php } ?>

            <a class="carousel-control-prev" href="#book-suggestions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#book-suggestions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
</div>