<?php
session_start();
include "db.php";

if (isset($_POST['request'])) {

    $request = $_POST['request'];

    $userid = $_SESSION['id'];

    if ($request != "") {

        $query = "SELECT * from applications where  status = '$request' AND  organizer_id = $userid ";
    } else {
        $query = "SELECT * from applications  where  status = '$request' AND  organizer_id = $userid ";
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
            <div class="box bg-white rounded-3 position-relative">
                <div class="info">
                    <h4 class="text-primary">
                        <?php echo $row['applicant_name'] ?>
                    </h4>
                    <h6>
                        <?php echo $row['applicant_email'] ?>
                    </h6>
                    <span>
                        <?php echo $row['applicant_phone'] ?>
                    </span>
                    <div class="fw-bold">
                        <a download href="upload/<?= $row['cv'] ?>" class="btn">DownLoad CV</a>
                    </div>
                    <div class="details d-flex align-items-center gap-2 top-0 text-align-center">
                        <?php
                        if ($row['status'] == '0') {
                            ?>
                            <h4> <span class="badge text-bg-secondary">Under Review</span></h4>
                            <?php
                        } else if ($row['status'] == '1') {
                            ?>
                                <h4><span class="badge text-bg-danger">Rejected</span></h4>
                            <?php
                        } else {
                            ?>
                                <h4><span class="badge text-bg-success">accepted</span></h4>
                            <?php
                        }
                        ?>
                    </div>

                </div>

                <!-- <a class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a> -->
                <span class="d-flex flex-wrap flex-column" style="width:100% ; align-items:end; justify-content:flex-start;">
                    <a href="reject.php?id=<?php echo $row['applicant_id']; ?>&id_job=<?php echo $row['listing_id']; ?>"
                        class="btn bg-danger" style="background-color: red ; color:white ; ">Reject</a>
                    <a href="accept.php?id=<?php echo $row['applicant_id']; ?>&id_job=<?php echo $row['listing_id']; ?>"
                        class="btn bg-success">Accept</a>
                    <a href="under_review.php?id=<?php echo $row['applicant_id']; ?>&id_job=<?php echo $row['listing_id']; ?>"
                        class="btn" style="background-color: green ; color:white ; ">Under Review</a>
                </span>
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