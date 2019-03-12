<?php
    //! Initial PHP

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
                            Sign In
                        </button>
                        <form action="../../../php/functions/login_member.php" method=POST class="dropdown-menu p-4 dropdown-menu-right" style="width: 15rem">
                            <div class="form-group">
                                <label for="cardnumber">Card Number</label>
                                <input name="cardnumber" type="text" class="form-control" id="cardnumber" placeholder="Card Number">
                            </div>
                            <div class="form-group">
                                <label for="cardpin">PIN</label>
                                <input name="pin" type="password" class="form-control" id="cardpin" placeholder="Card Pin">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</div>