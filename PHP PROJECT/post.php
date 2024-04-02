<?php
session_start();

if (isset($_SESSION['id'])) {
  include "db.php";
  include 'User.php';


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
      <h3>New Job!</h3>
      <div class="row">
        <div class="col-md-12">


          <?php
          if (isset($_POST['post'])) {
            $title = $_POST['title'];
            $description = $_POST['desc'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            $benefits = $_POST['benefits'];
            $salary = $_POST['salary'];
            $address = $_POST['address'];
            $company = $_POST['company'];
            $skills = $_POST['skills'];
            $category = $_POST['category'];
            $time = $_POST['time'];
            $requirements = $_POST['requirements'];
            $expiredate = $_POST['expireDate'];
            $id = $_SESSION['id'];

            if (isset($_FILES['picture']['name']) and !empty($_FILES['picture']['name'])) {

              $img_name = $_FILES['picture']['name'];
              $tmp_name = $_FILES['picture']['tmp_name'];
              $error = $_FILES['picture']['error'];

              if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_to_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png', 'jfif');
                if (in_array($img_ex_to_lc, $allowed_exs)) {
                  $new_img_name = uniqid($company, true) . '.' . $img_ex_to_lc;
                  $img_upload_path = './upload/' . $new_img_name;
                  move_uploaded_file($tmp_name, $img_upload_path);

                }
              }
            }

            $errors = array();

            if (empty($title) or empty($phone) or empty($email) or empty($address)) {
              array_push($errors, 'All fields are required');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              array_push($errors, 'Invalid email');
            }

            require_once "db.php";

            if (count($errors) > 0) {
              foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>" . $error . "</div>";
              }

            } else {
              $sql = "insert into listings (user_id,title,description,category_id,time_of_work,salary,skills,company,address,phone,email,requirements,benefits,picture,expire_date) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
              $stmt = mysqli_stmt_init($conn);
              $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
              if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ississsssssssss", $id, $title, $description, $category, $time, $salary, $skills, $company, $address, $phone, $email, $requirements, $benefits, $new_img_name, $expiredate);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>" . 'You are posting job successfully.' . "</div>";
              } else {
                die("Something went wrong");
              }
            }
          }


          ?>
          <form action="post.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="Title" />
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" name="desc" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
              <select name="category" id="">
                <option value="choose">choose</option>
                <option value="1">Graphic & Design</option>
                <option value="2">Music & Audio</option>
                <option value="3">Code & Programing</option>
                <option value="4">Account & Finance</option>
                <option value="5">Digital Marketing</option>
                <option value="6">Health & Care</option>
                <option value="7">Video & Animation</option>
                <option value="8">Data & Science</option>
              </select>
            </div>
            <div class="form-group">
              <select name="time" id="">
                <option value="choose">choose</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>

              </select>
            </div>
            <div class="form-group">
              <input name="expireDate" type="date">
            </div>

            <div class="form-group">
              <input name="salary" class="form-control" placeholder="salary" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="skills" placeholder="skills" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="company" placeholder=" company name" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="requirements" placeholder="requirements" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="address" placeholder="address" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="phone" placeholder="phone number" />
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="email" />
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="benefits" placeholder="rewards" />
            </div>
            <div class="form-group">
              <input type="file" class="form-control" name="picture" />
            </div>
            <div class="form-btn">
              <input type="submit" class="btn btn-info" name="post" value="post" />
            </div>
          </form>
          <a href="employer.php">my jobs</a>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="<KEY>"
      crossorigin="anonymous"></script>
  </body>

  </html>

<?php } else {
  header("Location: login.php");
  exit;
} ?>