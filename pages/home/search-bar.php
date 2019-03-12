<?php
    //! Initial PHP




?>

<!-- Search Bar -->
<div class="search" style="height: 25rem">
    <div class="jumbotron m-0 d-flex h-100" id="search-jumbotron">
        <div class="input-group w-75 m-auto justify-content-center align-self-center" style="min-width: 15rem">
            <form class="w-50" action="../../Library/Search/index.php" method="get">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <input type="text" placeholder="Search the library" class="form-control" id="search" name="search" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </div>
                <div class="form-group">

                    <!-- Search By Title -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio1" name="searchtype" value="title" checked>
                        <label class="form-check-label" for="inlineRadio1">Title</label>
                    </div>

                    <!-- Search By Author -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio2" name="searchtype" value="author">
                        <label class="form-check-label" for="inlineRadio2">Author</label>
                    </div>

                    <!-- Search By Key Word -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineRadio3" name="searchtype" value="key-word">
                        <label class="form-check-label" for="inlineRadio3">Key Word</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>