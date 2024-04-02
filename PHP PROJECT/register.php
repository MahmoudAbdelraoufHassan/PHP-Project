<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="register">

        <div class="container d-flex justify-content-center position-relative">
            
        <div class="form  rounded-2">

<form action="register.php" method="post" enctype="multipart/form-data">
    
    <h3 class="">Registeration</h3>
    <div class="row">
<div class="col-md-6">
<div class="form-group ">
<input type="text" class="form-control" name="fname" placeholder="First Name">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" class="form-control" name="lname" placeholder="Last Name">
</div>
</div>
</div>
<div class="form-group mt-4 mb-4">
    
    <textarea type="text" class="form-control " name="aboutme" placeholder="About Me"></textarea>
</div>
<div class="form-group mb-4">
    <input type="email" class="form-control" name="email" placeholder="email">
</div>

<div class="form-group mb-4">
    
    <input type="password" class="form-control" name="pass" placeholder="password">
</div>
<div class="form-group mb-4">
    
    <input type="text" class="form-control" name="city" placeholder="city">
</div>
<div class="row mb-4">
<div class="col-md-6">
<div class="form-group">
<select name="type" class="form-control">
    <option value="choose">User Type</option>
    <option value="employer">Employer</option>
    <option value="applicant">Applicant</option>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<select name="gender" class="form-control">
    <option value="choose">Gender</option>
    <option value="male" name="M">Male</option>
    <option value="female" name="F">Female</option>
</select>
</div>
</div>
</div>

<div class="form-group mb-4">
<input type="date" name="date" class="form-control">
</div>
<div class="form-group mb-4">
    <input type="file" class="form-control" name="pp">
</div>

<div class="row">
<div class="col-md-6">
<input type="submit" value="Register" class=" w-100 reg" name="submit">
</div>
<div class="col-md-6">
<a href="login.php" class="login">Login</a>
</div>
</div>

</form>
</div>
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

            
            echo "<div class='d-flex flex-column gap-2 er'>";
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger text-center me-2'>" . $error . "</div>";
                }
                echo "</div>"; 
                
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
        
       
    </div>
</div>
</body>

</html>