<?php
include_once 'connect.php';
session_start();
if (isset($_SESSION["username"]) || isset($_SESSION["entreprise_id"])) {
	header('location: ./home.php');
}

if (isset($_POST["submit"])) {
	$username = htmlspecialchars($_POST["username"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = $_POST["password"];

	$query1 = $db->prepare("SELECT username FROM entreprises WHERE username = ? ");
	$query1->execute([$username]);
	if ($query1->rowCount() > 0) {
		$err = "Utilisateur deja enregistré";
		echo $err;
	} else {
		if ($username == "") {
			$err = "Merci de renseigner un utilisateur";
			echo $err;
		} else {
			if (strlen($password) < 6) {
				$err = "Le mot de pass devrait faire plus de 5 caractère";
				echo $err;
			} else {
				$password = md5($password);
				$query = "INSERT INTO entreprises(username,email,password) VALUES(?,?,?)";
				$query = $db->prepare($query);
				if ($query->execute([$username, $email, $password])) {

					$id = (int) $_SESSION["entreprise_id"];

					$query = $db->prepare("SELECT * FROM entreprises WHERE entreprise_id = :id ");
					$query->bindParam(":id", $id);
					$query->execute();
					$user = $query->fetch();


					header('location: ./login.php');
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
</head>

<body>
	<div>
	<h1>ENTREPRISE
		 REGISTRATION</h1>
		<div>
			<div></div>
			<div>
				<div>
					<h3>Register</h3>
					<form method="post">
						<?php if (isset($err)) : ?>
							<div><?php echo $err ?></div>
						<?php endif ?>

						<?php if (isset($success)) : ?>
							<div>Successful</div>
						<?php endif ?>
						<div>
							<label>Username</label>
							<input required type="text" <?php if (isset($username)) : ?> value="<?php echo $username ?>" <?php endif ?> name="username">
						</div>
						<div>
							<label>Email</label>
							<input required type="email" <?php if (isset($email)) : ?> value="<?php echo $email ?>" <?php endif ?> name="email">
						</div>
						<div>
							<label>Password</label>
							<input required type="password" name="password">
						</div>

						<div>
							<button name="submit">Register & Login</button>
						</div>

						<p>Tu as deja un compte ? <a href="login.php">Connecte toi !</a></p>
					</form>
				</div>
			</div>
			<a href="../index.php">Choix du compte</a>
			<div></div>
		</div>
	</div>
</body>

</html>
