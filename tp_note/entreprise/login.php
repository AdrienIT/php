<?php  
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION["entreprise_id"])) {
		header('location: ./home.php');
	}

	if (isset($_POST["submit"])) {
		$username = $_POST["username"];
		$password = md5($_POST["password"]);

		$query1 = $db->prepare("SELECT * FROM entreprises WHERE username = ? AND password = ? ");
		$query1->execute([$username, $password]);
		$entreprise = $query1->fetch();


		if (count($entreprise) > 0) {
			$_SESSION['entreprise_id'] = $entreprise['entreprise_id'];
			header('Location: http://localhost/tp_note/entreprise/home.php');
		}
		else{ 
			$err = "Username / Password incorrect";
			echo $err;
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div>
		<h1>ENTREPRISE LOGIN</h1>
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
						<p>Pas encore de compte ? <a href="index.php">Inscrit toi !</a></p>
					</form>
				</div>	
			</div>
			<div></div>	
			<a href="../index.php">Choix du compte</a>
		</div>
	</div>
</body>
</html>