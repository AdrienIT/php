<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}
$session_username = $_SESSION['username'];


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
                    <h3>Welcome <?php echo $session_username ?></h3>
                    <h5>Your account details are: </h5>

                    <?php
                    $query = $db->prepare("SELECT * FROM entreprises WHERE username = ? ");
                    $query->execute([$session_username]);
                    $user = $query->fetch();

                    $confirme = $user["confirme"];
                    $username = $user["username"];
                    $email = $user["email"];

                    if ($confirme == 0) {
                        $confirme = 'Non';
                    } else {
                        $confirme = 'Oui';
                    }

                    ?>


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
                            <td>Compte confirmé :</td>
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