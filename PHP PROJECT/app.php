<?php
session_start();

if (isset($_SESSION['id']) && isset($_GET['id'])) {
  include "db.php";
  $job_id = intval($_GET['id']);
  $user = $_SESSION['id'];

} else {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="main.css" />
  <title>Application</title>
</head>

<body>


  <div class="container">

    <div class="row">
      <div class="col-md-12">

        <?php
        if (isset($_POST['apply']) && isset($_GET)) {
          require_once "db.php";
          $fname = $_POST['fullname'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $job_id = intval($_GET['id']);
          echo $job_id;
          echo $user;
          $sql = "SELECT * FROM listings WHERE id='" . $job_id . "'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_company = $row['user_id'];
          }
          /* ======================   upload image      =========================== */
          if (isset($_FILES['pic']['name']) and !empty($_FILES['pic']['name'])) {

            $img_name = $_FILES['pic']['name'];
            $tmp_name = $_FILES['pic']['tmp_name'];
            $error = $_FILES['pic']['error'];

            if ($error === 0) {
              $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              $img_ex_to_lc = strtolower($img_ex);

              $allowed_exs = array('jpg', 'jpeg', 'png', 'jfif');
              if (in_array($img_ex_to_lc, $allowed_exs)) {
                $new_img = uniqid($fname, true) . '.' . $img_ex_to_lc;
                $img_upload_path = './upload/' . $new_img;
                move_uploaded_file($tmp_name, $img_upload_path);

              }
            }
          }
          /*===================== end image =========================*/
          /* ===========  upload cv  =========== */
          if (isset($_FILES['pp']['name']) and !empty($_FILES['pp']['name'])) {

            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];

            if ($error === 0) {
              $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              $img_ex_to_lc = strtolower($img_ex);

              $allowed_exs = array('jpg', 'jpeg', 'png', 'jfif', 'pdf');
              if (in_array($img_ex_to_lc, $allowed_exs)) {
                $new_img_name = uniqid($fname, true) . '.' . $img_ex_to_lc;
                $img_upload_path = './upload/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

              }
            }
          }




          /* ===========  upload image  =========== */

          /* ============ validation  ============= */
          $errors = array();

          if (empty($fname) or empty($email) or empty($phone)) {
            array_push($errors, 'All fields are required');
          }
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Invalid email');
          }
          require_once "db.php";
          $sql1 = "select * from users where email = '$email'";
          $result1 = mysqli_query($conn, $sql1);
          $rowCount = mysqli_num_rows($result1);
          if ($rowCount = 0) {
            array_push($errors, 'Email is not found');
          }

          if (count($errors) > 0) {
            foreach ($errors as $error) {
              echo "<div class='alert alert-danger'>" . $error . "</div>";
            }
            /* ============ validation  ============= */
          } else {
            /* ============== insert data to database  =================*/
            require_once "db.php";
            if ($id_company != $user) {
              $sql = "insert into applications (listing_id,applicant_id,organizer_id,applicant_name,applicant_email,applicant_phone,pic,cv) values (?,?,?,?,?,?,?,?)";
              $stmt = mysqli_stmt_init($conn);
              $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
              if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "iiisssss", $job_id, $user, $id_company, $fname, $email, $phone, $new_img, $new_img_name);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>" . 'You are registered successfully.' . "</div>";


              } else {
                die("Something went wrong");
              }

            } else {
              echo "<div class='alert alert-danger'>" . 'You cannot apply to your own job' . "</div>";
            }






          }
        }


        /* ============== insert data to database  =================*/




        ?>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name" />
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="email" />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="phone" />
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="pic">
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="pp" accept=".pdf,.doc,.docx">
          </div>
          <div class="form-btn">
            <input type="submit" class="btn btn-info" name="apply" value="apply" />
          </div>
        </form>
        <a href="savedjob.php">home</a>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="<KEY>"
    crossorigin="anonymous"></script>
</body>

</html>