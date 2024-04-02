<?php
session_start();

if (isset($_SESSION['id'])) {
  include "db.php";
  include 'User.php';
  $userid = $_SESSION['id'];

  $user = getUserById($_SESSION['id'], $conn);

  $query = "SELECT * FROM listings as l inner join categories as c on l.category_id = c.categ_id limit 2";
  $result = mysqli_query($conn, $query);

  $query2 = "SELECT * FROM categories ";
  $result2 = mysqli_query($conn, $query2);

  $sql = "SELECT * FROM masseges ";
  $result3 = mysqli_query($conn, $sql);

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jop App</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
      .massege {
        position: absolute;
        background-color: white;
        border: 1px solid black;
        border-radius: 20px;
        top: 20%;
        right: 50%;
        padding: 25px;
        opacity: 0;
      }

      .active {
        opacity: 1;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
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
              <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="alljobsapplicant.php">All Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="savedjob.php">saved jobs</a>
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
                <a class="dropdown-item" href="#" id="msg">Some news</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Another news</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </div>
          <div class="massege">
            <?php
            while ($row = mysqli_fetch_array($result3)) {
              ?>
              <div class="massege-content">
                <div class="massege-icon">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="massege-text">
                  <h5>notification</h5>
                  <p>
                    <?php echo $row['msg'] ?>
                  </p>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <!-- Avatar -->
        <div class="dropdown">
          <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow " href="#"
            id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
            <img src="upload/<?= $user['picture'] ?>" class="rounded-circle" height="35"
              alt="Black and White Portrait of a Man" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end rounded-0 effect" aria-labelledby="navbarDropdownMenuAvatar">
            <li>
              <a class="dropdown-item  rounded-0" href="profile.php">My profile</a>
            </li>
            <li>
              <a class="dropdown-item  rounded-0" href="#">Settings</a>
            </li>
            <li>
              <a class="dropdown-item  rounded-0" href="Logout.php">Logout</a>
            </li>
          </ul>
        </div>
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <!-- Right elements -->

      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <!-- MDB -->
    <div class="landing">
      <div class="container">
        <div class="landing_head">
          <div class="text">
            <h1 class="mb-4 fw-bold">Discover Your Next
              <span class="text-primary">Career Move</span>
            </h1>
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sed quam reiciendis fugiat
              sunt ab atque quis eos autem accusantium, cumque numquam a perferendis possimus officiis saepe nam tempora
              ipsum.</p>
            <div class="landing-search">
              <input type="text" placeholder="Enter your job">
              <a href=" " class="bg-primary">search</a>
            </div>
          </div>
        </div>
        <div class="landing_image">
          <img src="./OC3QZ20.jpg" alt="" srcset="">
        </div>
      </div>
    </div>
    <!-- <div class="status">
    <div class="w-75 container bg-white d-flex rounded-2 align-items-center">
        <div class="box">
            <i class="fa-solid fa-user text-primary"></i>
            <div class="content">
              <h3 class="num">123+</h3>
                <p>User</p>
            </div>
        </div>
        <div class="box">
            <i class="fa-regular fa-building text-primary"></i>
            <div class="content">
              <h3 class="num">123+</h3>
              <p>User</p>
            </div>
        </div>
        <div class="box">
            <i class="fa-regular fa-circle-check text-primary"></i>
            <div class="content">
              <h3 class="num">123+</h3>
              <p>User</p>
            </div>
        </div>
    </div>
</div> -->
    <div class="category">
      <div class="component text-center mb-5">
        <h2 class="Job Listing text-black fw-bolder">Popular <span class="text-primary">Categories</span></h2>
      </div>
      <div class="container">
        <?php
        while ($row2 = mysqli_fetch_assoc($result2)) {
          ?>
          <div class="box">
            <div class="icon">
              <i class="fa-solid fa-code text-primary"></i>
            </div>
            <div class="content">
              <h6>
                <?php echo $row2['ategory_name'] ?>
              </h6>
            </div>
          </div>

          <?php
        }
        ?>


      </div>
    </div>
    <div class="jobList py-5">
      <div class="component text-center mb-5">
        <h2 class="Job Listing text-black fw-bolder">Latest <span class="text-primary">Jobs</span></h2>
      </div>
      <div class="container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="box bg-white rounded-3 position-relative">
            <div class="img bg-light rounded-3 border-1">
              <img src="upload/<?= $row['picture'] ?>" alt="">
            </div>
            <div class="info">
              <span class="text-primary">
                <?php $row['company'] ?>
              </span>
              <h4 class="fw-bold">
                <?= $row['title'] ?>
              </h4>
              <div class="details d-flex align-items-center gap-2">
                <span class="category bg-light-subtle p-1 px-2">
                  <?= $row['ategory_name'] ?>
                </span>
                <span class="time p-1 px-2 h-100 d-block">
                  <i class="fa-regular fa-clock text-primary"></i>
                  <?= $row['time_of_work'] ?>
                </span>

              </div>
            </div>
            <span class="date position-absolute">
              <?= $row['created_at'] ?>
            </span>
            <?php

            if ($row['created_at'] <= $row['expire_date']) {
              ?>
              <a class="btn  d-block align-self-center ms-auto shadow-none rounded-0"
                href="app.php?id=<?php echo $row['id'] ?>">Apply Now</a>

              <?php
            } else {
              ?>
              <span class="badge text-bg-danger p-1 mx-2"> this job unavailable </span>

              <?php
            }
            ?>

          </div>
          <?php
        }
        ?>
        <div class="d-flex justify-content-center mt-3">
          <a class="bg-primary rounded-0 shadow-none text-light px-4 py-2 mx-auto" href="alljobsapplicant.php">Show
            More</a>
        </div>
      </div>
    </div>
    <div class="about-us my-5">
      <div class="component text-center mb-5">
        <h2 class="Job Listing  fw-bolder">About <span class="text-primary">Us</span></h2>
      </div>
      <div class="container">
        <div class="content mt-3">
          <div class="row gap-5">
            <div class="col-md-5 col-sm-12 aboutImage">
              <img src="about.jpg" alt="" srcset="" class="w-100 rounded-3">
            </div>
            <div class="col-md-6 col-sm-12">
              <h3 class="text-primary fw-bold fs-1">Discover Our Story</h3>
              <ul class="d-flex gap-2 flex-column mt-3">
                <li class="about-item">
                  <i class="fa-solid fa-check"></i>
                  Connecting job seekers with meaningful employment opportunities and assisting companies in finding the
                  right talent.
                </li>
                <li class="about-item">
                  <i class="fa-solid fa-check"></i>
                  Transparency, accessibility, efficiency, and user satisfaction drive our platform.
                </li>
                <li class="about-item">
                  <i class="fa-solid fa-check"></i>
                  Meet the dedicated professionals behind Jobs who are committed to revolutionizing the job search
                  experience.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script>
      var msg = document.getElementById("msg");
      var div = document.querySelector(".massege");

      msg.addEventListener('click', function (e) {
        div.classList.add("active");
      })

    </script>
  </body>

  </html>
<?php } else {
  header("Location: login.php");
  exit;
} ?>