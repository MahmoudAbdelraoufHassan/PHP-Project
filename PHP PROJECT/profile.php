<?php
session_start();

if (isset($_SESSION['id'])) {
  include "db.php";
  include 'User.php';
  $user = getUserById($_SESSION['id'], $conn);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>

    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  </head>

  <body class="profile-body">
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
              <a class="nav-link" href="#">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Projects</a>
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
            <ul class="dropdown-menu dropdown-menu-end rounded-0 effect" aria-labelledby="navbarDropdownMenuAvatar">
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
          <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
        </div>
        <!-- Right elements -->

      </div>
      <!-- Container wrapper -->
    </nav>
    <div class="profile">
      <div class="container">
        <div class="card">
          <div class="box">
            <div class="image">
              <img src="upload/<?= $user['picture'] ?>" alt="">
            </div>
            <div class="profile-info">
              <h3>
                <?= $user['fname'] ?>
                <?= $user['lname'] ?>
              </h3>
              <h4>Front-End Developer</h4>
            </div>
          </div>
          <div class="box">
            <ul>
              <li>User Profile</li>
              <li>History</li>
            </ul>
          </div>
        </div>
        <div class="data">
          <h2 class="fw-bold mb-5 d-flex">Personal Information
            <!-- <i class="fa-solid fa-building text-primary ms-auto"> -->
            <i class="fa-solid fa-user text-primary ms-auto"></i>
            </i>
          </h2>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label text-black">First Name</label>
                <input type="text" class="form-control p-2" id="firstName" placeholder="Enter your first name"
                  value="<?= $user['fname'] ?>" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label text-black">Last Name</label>
                <input type="text" class="form-control p-2" id="lastName" placeholder="<?= $user['lname'] ?>" disabled>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-black">Email</label>
              <input type="email" class="form-control p-2" id="email" placeholder="<?= $user['email'] ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-black">Password</label>
              <input type="password" class="form-control p-2" id="password" placeholder="<?= $user['password'] ?>"
                disabled>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="address" class="form-label text-black">Address</label>
                <input type="text" class="form-control p-2" id="address" placeholder="<?= $user['city'] ?>" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phoneNumber" class="form-label text-black">Phone Number</label>
                <input type="text" class="form-control p-2" id="phoneNumber" placeholder="<?= $user['gender'] ?>"
                  disabled>
              </div>
            </div>
          </form>
          <a href="edit.php?id=<?php echo $user['id'] ?>">update</a>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  </body>

  </html>
<?php } else {
  header("Location: login.php");
  exit;
} ?>