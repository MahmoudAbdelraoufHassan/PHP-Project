<?php
session_start();

if (isset($_SESSION['id'])) {
    include "db.php";
    include 'User.php';
    $userid = $_SESSION['id'];
    $user = getUserById($_SESSION['id'], $conn);

    require_once "db.php";
    $query = "SELECT * FROM listings as l inner join categories as c on l.category_id = c.categ_id where user_id = $userid ";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);

    ?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jobs</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light w-100 p-3 bg-white">
            <!-- Container wrapper -->
            <div class="container">
                <!-- Toggle button -->
                <a class="navbar-brand mt-2 mt-lg-0 fw-bold" href="#">
                    LOGO
                </a>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <!-- Left links -->
                    <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="employer_requests.php">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="jobs.php">All Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employer.php
                            ">Home</a>
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Icon -->
                    <!-- <a class="link-secondary me-3" href="#">
              <i class="fas fa-shopping-cart"></i>
            </a> -->

                    <!-- Notifications -->
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="link-secondary me-3 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow " href="#"
                            id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                            <img src="upload/<?= $user['picture'] ?>" class="rounded-circle" height="35"
                                alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end rounded-0 effect"
                            aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item  rounded-0" href="profile.php">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item  rounded-0" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item  rounded-0" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <button data-mdb-collapse-init class="navbar-toggler" type="button"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <!-- Right elements -->

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <section>
            <div class="jobList py-5">
                <div class="component container mb-5">
                    <h2 class="Job Listing text-black fw-bolder">My Job
                        <span class="text-primary">List</span>
                    </h2>
                </div>
                <div class="container">
                    <div class="jobs">
                        <?php

                        while ($row = mysqli_fetch_assoc($result)) {
                            $URL = "id1=" . $row['id'] . "&id2=" . $row['user_id'];
                            $skills = explode(',', $row['skills']);

                            ?>
                            <div class="box bg-white rounded-3 position-relative">
                                <div class="img bg-light rounded-3 border-1 align-self-center">
                                    <img src="upload/<?php echo $row['picture'] ?>" alt="">
                                </div>
                                <div class="info">
                                    <span class="text-primary">
                                        <?php echo $row['company'] ?>
                                    </span>
                                    <h4 class="fw-bold">
                                        <?php echo $row['title'] ?>
                                    </h4>
                                    <div class="details d-flex align-items-center gap-2">
                                        <span class="category bg-light-subtle p-1 px-2">
                                            <?php echo $row['ategory_name'] ?>
                                        </span>
                                        <span class="time p-1 px-2 h-100 d-block">
                                            <i class="fa-regular fa-clock text-primary"></i>
                                            <?php echo $row['time_of_work'] ?>
                                        </span>
                                        <span class="time p-1 px-2 h-100 d-block">
                                            <i class="fa-solid fa-dollar-sign text-primary"></i>
                                            <?php echo $row['salary'] ?>
                                        </span>
                                        <span class="time p-1 px-2 h-100 d-block">
                                            <i class="fa-solid fa-location-dot text-primary"></i>
                                            <?php echo $row['address'] ?>
                                        </span>
                                    </div>
                                    <div class="div">
                                        <?php foreach ($skills as $skill)

                                            echo '<span class="badge text-bg-light border border-primary p-1 mt-2 mx-2">' . $skill . '</span>';
                                        ?>
                                    </div>
                                </div>
                                <span class="date position-absolute">
                                    <?php echo $row['created_at'] ?>
                                </span>

                                <?php
                                if ($result === true) {
                                    echo '<span class="badge text-bg-danger p-3 mx-2 position-absolute" style="right:20px; top:50px">' . "Expired" . '</span>';

                                } else {
                                    echo '<span class="badge text-bg-success p-3 mx-2 position-absolute" style="right:20px; top:50px">' . "Active" . '</span>';
                                }
                                ?>

                                <!-- <a class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a> -->
                            </div>
                            <?php

                        }
                        ?>
                    </div>



                    <!-- categories -->
                </div>
            </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
        <script src="jquery.js"></script>
        <script src="date.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>