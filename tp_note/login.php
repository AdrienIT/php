<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div>
		<div>
			<div></div>	
			<div>
				<div>
					<h3>Login</h3>
					<form method="post">
						<?php if (isset($err)): ?>
							<div><?php echo $err ?></div>
						<?php endif ?>
						<div>
							<label>Username</label>
							<input required type="text" name="username">
						</div>
						<div>
							<label>Password</label>
							<input required type="password" name="password">
						</div>
						
						<div>
							<button name="submit">Login</button>
						</div>
						<p>Don't have an account before? <a href="index.php">register</a></p>
					</form>
				</div>	
			</div>
			<div></div>	
		</div>
	</div>
</body>
</html>

<?php  
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION["username"])) {
		header('location: home.php');
	}

	if (isset($_POST["submit"])) {
		$username = $_POST["username"];
		$password = md5($_POST["password"]);

		$query1 = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
		$query1->execute([$username, $password]);
		if ($query1->rowCount() > 0) {
			$_SESSION['username'] = $username;
			header('location: home.php');
		}
		else{ 
			$err = "Invalid Credentials";
		}
	}
?>

