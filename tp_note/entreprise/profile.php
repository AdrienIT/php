<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["entreprise_id"])) {
    header('location: index.php');
}

$id = (int) $_SESSION["entreprise_id"];

$query = $db->prepare("SELECT * FROM entreprises WHERE entreprise_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$username = $user["username"];
$email = $user["email"];
$confirme = $user["confirme"];

if ($confirme == 0) {
    $confirme = 'Non';
} else {
    $confirme = 'Oui';
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
</head>

<body>
    <div>
        <div>
            <div></div>
            <div>
                <div>
                    <h3>Welcome <?php echo $username ?></h3>
                    <h5>Your account details are: </h5>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $username ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td>Compte confirme ? : </td>
                            <td><?php echo $confirme ?></td>
                        </tr>
                    </table>

                    <br>
                    <a href="logout.php" style="text-decoration:none"> → Logout</a> <br>
                    <a href="update.php" style="text-decoration:none"> → Update Account</a> <br>
                    <a href="delete.php" style="text-decoration:none"> → Delete Account</a>
                    <br>
                    <br>
                </div>
            </div>
            <ul>
                <li> <a href="home.php" style="text-decoration:none">HomePage</a> </li>
            </ul>
            <div></div>
        </div>
    </div>
</body>

</html>