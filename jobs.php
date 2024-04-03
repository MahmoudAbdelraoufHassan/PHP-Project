<?php
session_start();

if (isset($_SESSION['id'])) {
    include "db.php";
    include 'User.php';
    $userid = $_SESSION['id'];
    $user = getUserById($_SESSION['id'], $conn);

    $query = "SELECT * FROM listings as l inner join categories as c on l.category_id = c.categ_id";
    $result = mysqli_query($conn, $query);
}
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
    <style>
        .btn {
            display: none !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light w-100 p-3 bg-white">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <a class="navbar-brand mt-2 mt-lg-0 fw-bold nav_logo" href="#">
                JOBS
            </a>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <!-- Left links -->
                <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">All Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employerJob.php">My Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employer.php">Home</a>
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
                    </a>
                </div>
                <!-- Avatar -->
                <div class="dropdown">
                    <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow " href="#"
                        id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                        <img src="upload/<?= $user['picture'] == null ? "user.png" : $user['picture'] ?>"
                            class="rounded-circle" height="35" alt="Black and White Portrait of a Man" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-0 effect"
                        aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item  rounded-0" href="profile.php">My profile</a>
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
                <h2 class="Job Listing text-black fw-bolder">Job
                    <span class="text-primary">List</span>
                </h2>
            </div>
            <div class="container">
                <div class="jobs">
                </div>
                <div class="filters">
                    <h4>Search Jobs</h4>
                    <div class="search d-flex justify-content-space-between" style="justify-content: space-between">
                        <input type="text" class="input" placeholder="Search for Jobs" id="input-search">
                        <button>
                            <img src="./search.png" alt="" class="btn-search">
                        </button>
                    </div>
                    <div class="categories">
                        <h3>Categories</h3>
                        <ul class="category-list">
                            <!-- <li  class="category-item">
                        <img src="laptop.png" alt="" srcset="">
                        <span>Development</span>
                    </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
    </section>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="jquery.js"></script>
    <script src="main.js"></script>

    <script src="date.js"></script>
</body>

</html>