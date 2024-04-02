<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="main.css">

</head>

<body>
	<div class="container">
		<?php
		if (isset($_POST['login'])) {
			$email = $_POST['email'];
			$password = $_POST['pass'];

			require_once "db.php";
			$sql = "select * from users where email = '$email'";
			$result = mysqli_query($conn, $sql);
			$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($user) {
				if (password_verify($password, $user["password"])) {
					if ($user['user_type'] === 'employer') {
						header("Location: employer.php");
						session_start();
						$_SESSION['id'] = $user['id'];
						$_SESSION['name'] = $user['fname'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['picture'] = $user['picture'];
						$_SESSION['location'] = $user['city'];
						$_SESSION['date'] = $user['birth_date'];
						$_SESSION['type'] = $user['type'];
						die();

					} else {
						header("Location: applicant.php");
						session_start();
						$_SESSION['id'] = $user['id'];
						$_SESSION['name'] = $user['fname'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['picture'] = $user['picture'];
						$_SESSION['location'] = $user['city'];
						$_SESSION['date'] = $user['birth_date'];
						$_SESSION['type'] = $user['type'];
						die();

					}
				} else {
					echo "<div class='alert alert-dander'>" . "Password doesn't match " . "</div>";
				}

			} else {
				echo "<div class='alert alert-danger'>" . "Email doesn't match" . "</div>";
			}
		}
		?>
		<form action="login.php" method="post">
			<div class="form-group">
				<input type="email" placeholder="Enter Email PLZ" name="email" class="form-control">
			</div>
			<div class="form-group">
				<input type="password" placeholder="Enter Password PLZ" name="pass" class="form-control">
			</div>
			<div class="form-btn">
				<input type="submit" value="Login" name="login" class="btn btn-primary">
			</div>
		</form>
		<a href="register.php" class="btn btn-primary">Sign Up</a>
	</div>

</body>

</html>