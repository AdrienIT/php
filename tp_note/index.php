<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<div>
		<div>
			<div></div>	
			<div>
				<div>
					<h3>Register</h3>
					<form method="post">
						<?php if (isset($err)): ?>
							<div><?php echo $err ?></div>
						<?php endif ?>

						<?php if (isset($success)): ?>
							<div>Successful</div>
						<?php endif ?>
						<div>
							<label>Username</label>
							<input required type="text" <?php if (isset($username)):?>
							value="<?php echo $username ?>"<?php endif ?> 
							name="username">
						</div>
						<div>
							<label>Email</label>
							<input required type="email" <?php if (isset($email)):?>
							value="<?php echo $email ?>"<?php endif ?> 
							name="email">
						</div>
						<div>
							<label>Password</label>
							<input required type="password" name="password">
						</div>
						
						<div>
							<button name="submit">Register & Login</button>
						</div>

						<p>Already have an account before ? <a href="login.php">login</a></p>
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
		$email = $_POST["email"];
		$password = $_POST["password"];

		$query1 = $db->prepare("SELECT username FROM users WHERE username = ? ");
		$query1->execute([$username]);
		if ($query1->rowCount() > 0) {
			$err = "Username already registered";
		}
		else{
			if ($username =="") {
				$err = "Username cannot be empty";
			}
			else{
				if (strlen($password) < 6) {
					$err = "Password should be more than 5 characters";
				}
				else
				{
					$password = md5($password);
					$query = "INSERT INTO users(username,email,password) VALUES(?,?,?)";
					$query = $db->prepare($query);
					if ($query->execute([$username,$email,$password])) {
						$_SESSION["username"] = $username;
						header('location: home.php');
					}
				}
			}
		}


		
	}
?>
