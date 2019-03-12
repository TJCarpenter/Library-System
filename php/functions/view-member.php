<?php
// Include 
include($_SERVER["DOCUMENT_ROOT"] . "/php/functions/connect.php");


function generate_row() {
    // Returns member info from the member database

    // Connect to the Database
    $conn = connect();

    // Create the SELECT statement
    $sql = 'SELECT member_card_number, member_first_name, member_last_name FROM `Library`.`member`';

    // Get the results of the query
    $result = $conn->query($sql);

    $i = 0;
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            print_row(
                $row["member_card_number"],
                $row['member_first_name'], 
                $row['member_last_name'], 
                $i++
            );
        }
    } else {
        echo "0 results";
    }
    
    $conn->close();

    // Return the results if everything is there
}
?>

<?php
function print_row($card_number, $first_name, $last_name, $index) {
?>
    <div class="row border p-3 my-2" id="member-<?php echo $index ?>">

        <!-- Image -->
        <div class="col-2">
            <div class="d-flex align-items-center">
                <img src="../../../../src/img/placeholder/profile/profile_12.png" alt="Profile Picture" class="mx-auto"
                    width="50" height="50">
            </div>
        </div>

        <!-- Name and Badge Number -->
        <div class="col-4 d-flex h-100 my-auto">
            <div class="row text-left">
                <strong><?php echo $last_name . ', ' . $first_name;?></strong>
            </div>
        </div>

        <!-- Job Title -->
        <div class="col-4 d-flex h-100 my-auto">
            <div class="row mx-auto">
                <em><?php echo $card_number; ?></em>
            </div>
        </div>

        <!-- Edit Member-->
        <div class="col-1 d-flex h-100 my-auto">
            <input class="" type="image" src="./src/icons/edit/edit.svg" alt="" width="30px" height="30px" data-toggle="modal"
                data-target="#modal-member-<?php echo $index ?>-edit">
        </div>

        <!-- Remove Member -->
        <div class="col-1 d-flex h-100 my-auto">
            <input class="" type="image" src="./src/icons/remove/remove.svg" alt="" width="30px" height="30px" data-toggle="modal"
                data-target="#modal-member-<?php echo $index ?>-remove">
        </div>

    </div>

<?php
}
?>

<?php
function generate_modal() {

    // Connect to the Database
    //include($_SERVER["DOCUMENT_ROOT"] . "/php/functions/connect.php");
    $conn = connect();

    // Create the SELECT statement
    $sql = 'SELECT * FROM `Library`.`member`';

    // Get the results of the query
    $result = $conn->query($sql);

    $i = 0;
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            print_modal(
                $row["member_card_number"],
                $row["member_pin"],
                $row["member_first_name"],
                $row["member_last_name"],
                $row["member_birth_date"],
                $row["member_street"],
                $row["member_city"],
                $row["member_state"],
                $row["member_zip"],
                $row["member_phone_number"],
                $row["member_email"],
                $i++
            );
        }
    } else {
        echo "0 results";
    }
    
    $conn->close();
}
?>

<?php
function print_modal($card_number, $pin, $first_name, $last_name, $birthdate, $street, $city, $state, $zip, $phone_number, $email, $index) {
?>
    <!-- Modal Edit-->
    <div class="modal fade" id="modal-member-<?php echo $index ?>-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $first_name . " " . $last_name ?></h5>
                    <div class="col-2 d-flex h-100 my-auto">
                        <input type="image" src="./src/icons/lock/lock.svg" id="edit_lock_Member_<?php echo $index ?>" alt="" width="50%" height="50%"
                            onclick="unlock_<?php echo $index ?>();">
                    </div>

                    <script>
                        function unlock_<?php echo $index ?>() {
                            document.getElementById("edit_lock_Member_<?php echo $index ?>").src = "./src/icons/unlock/unlock.svg";
                            document.getElementById("edit_lock_Member_<?php echo $index ?>").setAttribute("onclick", "lock_<?php echo $index ?>();_<?php echo $index ?>");

                            
                            document.getElementById("edit_First_Name_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Last_Name_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Birthdate_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Street_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_City_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_State_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Zip_member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Phone_Number_Member_<?php echo $index ?>").disabled = false;
                            document.getElementById("edit_Email_Member_<?php echo $index ?>").disabled = false;

                        }

                        function lock_<?php echo $index ?>() {
                            document.getElementById("edit_lock_Member_<?php echo $index ?>").src = "./src/icons/lock/lock.svg";
                            document.getElementById("edit_lock_Member_<?php echo $index ?>").setAttribute("onclick", "unlock_<?php echo $index ?>();");

                            document.getElementById("edit_First_Name_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Last_Name_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Birthdate_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Street_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_City_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_State_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Zip_member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Phone_Number_Member_<?php echo $index ?>").disabled = true;
                            document.getElementById("edit_Email_Member_<?php echo $index ?>").disabled = true;
                        }
                    
                    </script>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">

                    <div class="form-group row mb-0">

                        <!-- First Name Input -->
                        <label for="edit_First_Name_Member_<?php echo $index ?>" class="col-sm-3 col-form-label my-1">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control my-1" id="edit_First_Name_Member_<?php echo $index ?>" placeholder="<?php echo $first_name ?>"
                                disabled>
                        </div>

                        <!-- Last Name Input -->
                        <label for="edit_Last_Name_Member_<?php echo $index ?>" class="col-sm-3 col-form-label my-1">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control my-1" id="edit_Last_Name_Member_<?php echo $index ?>" placeholder="<?php echo $last_name ?>"
                                disabled>
                        </div>

                        <!-- Birthdate -->
                        <label for="edit_Birthdate_Member_<?php echo $index ?>" class="col-2 col-form-label my-1">Birthdate</label>
                        <div class="col-10">
                            <input class="form-control my-1" type="date" value="<?php echo $birthdate ?>" id="edit_Birthdate_Member_<?php echo $index ?>"
                                disabled>
                        </div>

                    </div>

                    <br>

                    <!-- Address Information -->
                    <!-- 
                        DB Input:
                            member_street [varchar(255)]
                            member_city [varchar(255)]
                            member_state [varchar(255)]
                            member_zip [int(10)]
                    -->
                    <div class="form-row">

                        <!-- Street Name Input-->
                        <label for="edit_Street_Member_<?php echo $index ?>" class="col-sm-2 col-form-label my-1">Street</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control my-1" id="edit_Street_Member_<?php echo $index ?>" placeholder="<?php echo $street ?>"
                                disabled>
                        </div>

                        <!-- City Name Input-->
                        <label for="edit_City_Member_<?php echo $index ?>" class="col-sm-2 col-form-label my-1 text-right">City</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control my-1" id="edit_City_Member_<?php echo $index ?>" placeholder="<?php echo $city ?>" disabled>
                        </div>

                        <!-- State Input -->
                        <label for="edit_State_Member_<?php echo $index ?>" class="col-sm-2 col-form-label my-1">State</label>
                        <div class="col-md-4">
                            <select id="edit_State_Member_<?php echo $index ?>" class="form-control my-1" disabled>
                                <option selected>Choose...</option>
                                <option value="AL" <?php if($state == "AL") { echo "selected"; } ?> >Alabama</option>
                                <option value="AK" <?php if($state == "AK") { echo "selected"; } ?>>Alaska</option>
                                <option value="AZ" <?php if($state == "AZ") { echo "selected"; } ?>>Arizona</option>
                                <option value="AR" <?php if($state == "AR") { echo "selected"; } ?>>Arkansas</option>
                                <option value="CA" <?php if($state == "CA") { echo "selected"; } ?>>California</option>
                                <option value="CO" <?php if($state == "CO") { echo "selected"; } ?>>Colorado</option>
                                <option value="CT" <?php if($state == "CT") { echo "selected"; } ?>>Connecticut</option>
                                <option value="DE" <?php if($state == "DE") { echo "selected"; } ?>>Delaware</option>
                                <option value="DC" <?php if($state == "DC") { echo "selected"; } ?>>District Of Columbia</option>
                                <option value="FL" <?php if($state == "FL") { echo "selected"; } ?>>Florida</option>
                                <option value="GA" <?php if($state == "GA") { echo "selected"; } ?>>Georgia</option>
                                <option value="HI" <?php if($state == "HI") { echo "selected"; } ?>>Hawaii</option>
                                <option value="ID" <?php if($state == "ID") { echo "selected"; } ?>>Idaho</option>
                                <option value="IL" <?php if($state == "IL") { echo "selected"; } ?>>Illinois</option>
                                <option value="IN" <?php if($state == "IN") { echo "selected"; } ?>>Indiana</option>
                                <option value="IA" <?php if($state == "IA") { echo "selected"; } ?>>Iowa</option>
                                <option value="KS" <?php if($state == "KS") { echo "selected"; } ?>>Kansas</option>
                                <option value="KY" <?php if($state == "KY") { echo "selected"; } ?>>Kentucky</option>
                                <option value="LA" <?php if($state == "LA") { echo "selected"; } ?>>Louisiana</option>
                                <option value="ME" <?php if($state == "ME") { echo "selected"; } ?>>Maine</option>
                                <option value="MD" <?php if($state == "MD") { echo "selected"; } ?>>Maryland</option>
                                <option value="MA" <?php if($state == "MA") { echo "selected"; } ?>>Massachusetts</option>
                                <option value="MI" <?php if($state == "MI") { echo "selected"; } ?>>Michigan</option>
                                <option value="MN" <?php if($state == "MN") { echo "selected"; } ?>>Minnesota</option>
                                <option value="MS" <?php if($state == "MS") { echo "selected"; } ?>>Mississippi</option>
                                <option value="MO" <?php if($state == "MO") { echo "selected"; } ?>>Missouri</option>
                                <option value="MT" <?php if($state == "MT") { echo "selected"; } ?>>Montana</option>
                                <option value="NE" <?php if($state == "NE") { echo "selected"; } ?>>Nebraska</option>
                                <option value="NV" <?php if($state == "NV") { echo "selected"; } ?>>Nevada</option>
                                <option value="NH" <?php if($state == "NH") { echo "selected"; } ?>>New Hampshire</option>
                                <option value="NJ" <?php if($state == "NJ") { echo "selected"; } ?>>New Jersey</option>
                                <option value="NM" <?php if($state == "NM") { echo "selected"; } ?>>New Mexico</option>
                                <option value="NY" <?php if($state == "NY") { echo "selected"; } ?>>New York</option>
                                <option value="NC" <?php if($state == "NC") { echo "selected"; } ?>>North Carolina</option>
                                <option value="ND" <?php if($state == "ND") { echo "selected"; } ?>>North Dakota</option>
                                <option value="OH" <?php if($state == "OH") { echo "selected"; } ?>>Ohio</option>
                                <option value="OK" <?php if($state == "OK") { echo "selected"; } ?>>Oklahoma</option>
                                <option value="OR" <?php if($state == "OR") { echo "selected"; } ?>>Oregon</option>
                                <option value="PA" <?php if($state == "PA") { echo "selected"; } ?>>Pennsylvania</option>
                                <option value="RI" <?php if($state == "RI") { echo "selected"; } ?>>Rhode Island</option>
                                <option value="SC" <?php if($state == "SC") { echo "selected"; } ?>>South Carolina</option>
                                <option value="SD" <?php if($state == "SD") { echo "selected"; } ?>>South Dakota</option>
                                <option value="TN" <?php if($state == "TN") { echo "selected"; } ?>>Tennessee</option>
                                <option value="TX" <?php if($state == "TX") { echo "selected"; } ?>>Texas</option>
                                <option value="UT" <?php if($state == "UT") { echo "selected"; } ?>>Utah</option>
                                <option value="VT" <?php if($state == "VT") { echo "selected"; } ?>>Vermont</option>
                                <option value="VA" <?php if($state == "VA") { echo "selected"; } ?>>Virginia</option>
                                <option value="WA" <?php if($state == "WA") { echo "selected"; } ?>>Washington</option>
                                <option value="WV" <?php if($state == "WV") { echo "selected"; } ?>>West Virginia</option>
                                <option value="WI" <?php if($state == "WI") { echo "selected"; } ?>>Wisconsin</option>
                                <option value="WY" <?php if($state == "WY") { echo "selected"; } ?>>Wyoming</option>
                            </select>
                        </div>

                        <!-- State Input -->
                        <label for="edit_Zip_member_<?php echo $index ?>" class="col-sm-2 col-form-label my-1 text-right">ZIP Code</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control my-1" id="edit_Zip_member_<?php echo $index ?>" placeholder="<?php echo $zip ?>"
                                disabled>
                        </div>
                    </div>

                    <br>


                    <!-- Contact Information -->
                    <!-- 
                    DB Input:
                        member_phone_number [varchar(255)]
                        member_email [varchar(255)]
                    -->
                    <div class="form-row">

                        <!-- Phone Number -->
                        <label for="edit_Phone_Number_Member_<?php echo $index ?>" class="col-sm-4 col-form-label my-1">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control my-1" id="edit_Phone_Number_Member_<?php echo $index ?>" placeholder="<?php echo $phone_number ?>"
                                disabled>
                        </div>

                        <!-- Email Input -->
                        <label for="edit_Email_Member_<?php echo $index ?>" class="col-sm-2 col-form-label my-1">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control my-1" id="edit_Email_Member_<?php echo $index ?>" placeholder="<?php echo $email ?>"
                                disabled>
                        </div>

                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Remove Modal -->
    <div class="modal fade" id="modal-member-<?php echo $index ?>-remove" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Remove Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <img src="../../../../src/img/placeholder/profile/profile_12.png"
                                    alt="Profile Picture" class="mx-auto" width="50" height="50">
                            </div>

                        </div>

                        <!-- Name and Badge Number -->
                        <div class="col-6">
                            <div class="row text-left"><strong><?php echo $last_name . ", " . $first_name ?></strong></div>
                            <div class="row text-left"><em><?php echo $card_number ?></em></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Remove Member</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
