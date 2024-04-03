<?php
session_start();
include "db.php";

if (isset($_POST['request'])) {

    $request = $_POST['request'];
    $userid = $_SESSION['id'];

    if ($request != "") {

        $query = "SELECT * FROM applications as a inner join listings as l  on  a.listing_id  = l.id  where a.applicant_id = '$userid'  AND a.status = '$request'";
        ;
    } else {
        $query = "SELECT * from applications as a inner join listings as l  on  a.listing_id  = l.id  where a.applicant_id =  '$userid' ";
    }
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);


}

?>
<div class="jobs">
    <?php
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="box bg-white rounded-3 position-relative saved justify-content-between">

                <div class="info">
                    <h4 class="text-primary">
                        <?php echo $row['applicant_name'] ?>
                    </h4>
                    <span class="fw-bold">
                        <?php echo $row['applicant_phone'] ?>
                    </span>
                    <div class="details d-flex align-items-center gap-2">
                        <span class="category bg-light-subtle p-1 px-2">
                            <?php echo $row['applicant_email'] ?>
                        </span>

                    </div>
                </div>
                <?php
                if ($row['status'] == '0') {
                    ?>
                    <h4 class="d-flex flex-column align-items-center"> Status <span class='badge text-bg-secondary'>Under Review
                        </span></h4>

                    <?php
                } elseif ($row['status'] == '1') {
                    ?>
                    <h4 class="d-flex flex-column align-items-center"> Status <span class='badge text-bg-danger'>Rejected </span>
                    </h4>
                    <?php
                } elseif ($row['status'] == '2') {
                    ?>
                    <h4 class="d-flex flex-column align-items-center"> Status <span class='badge text-bg-success'>accepted </span>
                    </h4>
                    <?php
                }
                ?>
                <div class="info">
                    <h4 class="text-primary">
                        <?php echo $row['title'] ?>
                    </h4>
                    <span class="fw-bold">
                        <?php echo $row['description'] ?>
                    </span>
                    <div class="details d-flex align-items-center gap-2">
                        <span class="category bg-light-subtle p-1 px-2">
                            <?php echo $row['email'] ?>
                        </span>
                    </div>
                </div>
                <!-- <a class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a> -->
            </div>
            <?php
        }
    } else {
        ?>
        <h3 class="d-flex justify-content-center  align-items-center">No Results</h3>
        <?php
    }
    ?>

</div>