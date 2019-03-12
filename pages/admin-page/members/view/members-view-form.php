
<!-- Edit Mmeber -->
<div class="my-2 tab-pane fade" id="list-view-member" role="tabpanel" aria-labelledby="list-view-member-list">
    <h3 class="text-center">View Member</h3>

    <h5 class="text-center">Select a member to view, edit, or remove</h5>
    <hr>

<?php

    include($_SERVER["DOCUMENT_ROOT"] . "/php/functions/view-member.php");

    generate_row();

?>
</div>

<?php
    generate_modal();
?>


