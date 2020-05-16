<?php
include_once 'connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header('location: index.php');
}

$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = ? ");
$query->execute([$id]);
$user = $query->fetch();

if (isset($user["user_id"])) {
    if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['username']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $update_pseudo = $db->prepare("UPDATE users SET username = :username WHERE user_id = :id");
        $update_pseudo->bindParam(":username",$newpseudo);
        $update_pseudo->bindParam(":id",$id);
        $update_pseudo->execute();
        header('Location: update.php?id='.$id);
    }
    if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email']) {
        $newemail = htmlspecialchars($_POST['newmail']);
        $update_email = $db->prepare('UPDATE users SET email = :email WHERE user_id = :id');
        $update_email->bindParam(":email",$newemail);
        $update_email->bindParam(":id",$id);
        $update_email->execute();
        header('Location: update.php?id='.$id);
    }
    if (isset($_POST['newpasswd1']) and !empty($_POST['newpasswd1']) and isset($_POST['newpasswd2']) and !empty($_POST['newpasswd2'])) {
        $passwd1 = md5($_POST['newpasswd1']);
        $passwd2 = md5($_POST['newpasswd2']);
        if ($passwd1  == $passwd2) {
            $update_password = $db->prepare('UPDATE users SET password = :password WHERE user_id = :id');
            $update_password->bindParam(":password",$passwd1);
            $update_password->bindParam(":id",$id);
            $update_password->execute();
            header('Location: update.php?id='.$id);
        } else {
            $err_passwd = "Les mdp ne correspondent pas";
            echo $err_passwd;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Edition de profil</title>
</head>

<body>
    <h1>Edition de profil</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Pseudo : </label>
        <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['username']; ?>"> <br> <br>
        <label>E-Mail : </label>
        <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>"> <br> <br>
        <label>Mot de passe : </label>
        <input type="password" name="newpasswd1" placeholder="Password"> <br> <br>
        <label>Confirmation - Mot de passe</label>
        <input type="password" name="newpasswd2" placeholder="Password"> <br> <br>
        <input type="submit" value="Mettre à jour le profil !">
    </form>
    <a href="profile.php">Retour au profil</a>

</html>