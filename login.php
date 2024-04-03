<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="style.css">

</head>

<body class="register">
		<div>

		<div class="container mt-5 d-flex justify-content-center position-relative">
			<div class="form  rounded-2 mx-auto">
				<form action="login.php" method="post">
					<h3 class="log">Login</h3>
					<div class="form-group  mb-4">
						<input type="email" placeholder="Enter Email" name="email" class="form-control p-2">
					</div>
					<div class="form-group  mb-4">
						<input type="password" placeholder="Enter Password" name="pass" class="form-control p-2">
					</div>
					<div class="form-btn  mb-4">
						<input type="submit" value="Login" name="login" class="reg w-100">
					</div>
				</form>
				<a href="register.php" class="login">Regiter</a>
			</div>
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
							$_SESSION['type'] = $user['user_type'];
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
							$_SESSION['type'] = $user['user_type'];
							die();

						}
					} else {
						echo "<div class='er'>";
						echo "<div class='alert alert-danger'>" . "Password doesn't match " . "</div>";
						echo "</div>";
					}

				} else {
					echo "<div class='er'>";
					echo "<div class='alert alert-danger'>" . "Email doesn't match" . "</div>";
					echo "</div>";
				}
			}
			?>

		</div>
	</div>

</body>

</html>