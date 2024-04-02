<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">

        <?php
        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $city = $_POST['city'];
            $type = $_POST['type'];
            $gender = $_POST['gender'];
            $age = $_POST['date'];

            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            if (isset($_FILES['pp']['name']) and !empty($_FILES['pp']['name'])) {

                $img_name = $_FILES['pp']['name'];
                $tmp_name = $_FILES['pp']['tmp_name'];
                $error = $_FILES['pp']['error'];

                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png', 'jfif');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        $new_img_name = uniqid($fname, true) . '.' . $img_ex_to_lc;
                        $img_upload_path = './upload/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                    }
                }
            }



            $errors = array();

            if (empty($fname) or empty($lname) or empty($email) or empty($password) or empty($city) or empty($type) or empty($gender) or empty($age)) {
                array_push($errors, 'All fields are required');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'Invalid email');
            }
            if (strlen($password) < 8) {
                array_push($errors, 'Password must be at least 8 characters');
            }
            require_once "db.php";
            $sql = "select * from users where email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, 'Email already exists');
            }


            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>" . $error . "</div>";
                }

            } else {

                $sql = "insert into users (fname,lname,email,password,user_type,city,gender,birth_date,picture) values (?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $lname, $email, $pass_hash, $type, $city, $gender, $age, $new_img_name);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>" . 'You are registered successfully.' . "</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }



        ?>

        <form action="register.php" method="post" enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Register</h4><br>

            <div class="form-gruop">
                <input type="text" class="form-control" name="fname" placeholder="first">
            </div>

            <div class="form-group mt-4">

                <input type="text" class="form-control" name="lname" placeholder="last">
            </div>
            <div class="form-group mt-4">

                <textarea type="text" class="form-control" name="aboutme" placeholder="About Me"></textarea>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="email">
            </div>

            <div class="form-group">

                <input type="password" class="form-control" name="pass" placeholder="password">
            </div>
            <div class="form-group">

                <input type="text" class="form-control" name="city" placeholder="city">
            </div>
            <div class="form-group">
                <select name="type" id="">
                    <option value="choose">choose</option>
                    <option value="employer">employer</option>
                    <option value="applicant">applicant</option>
                </select>
            </div>
            <div class="form-group">
                <select name="gender" id="">
                    <option value="choose">choose</option>
                    <option value="male" name="M">M</option>
                    <option value="female" name="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <input type="date" name="date" id="">
            </div>

            <div class="form-group">
                <input type="file" class="form-control" name="pp">
            </div>
            <div class="form-btn">
                <input type="submit" value="Register" class="btn btn-primary" name="submit">
                <a href="login.php" class="link-secondary">Login</a>
            </div>
        </form>

    </div>
</body>

</html>