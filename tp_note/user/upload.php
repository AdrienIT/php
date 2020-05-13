<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}
$session_username = $_SESSION['username'];

$query = $db->prepare("SELECT * FROM users WHERE username = ? ");
$query->execute([$session_username]);
$user = $query->fetch();

$username = $user["username"];

?>

<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    $path = "./" . $username . "/";

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = $username . "." . $fileActualExt;
                $fileDestination = $path . $fileNameNew;
                if (!is_dir($path)) {
                    mkdir($path, 0700);
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "File uploaded with success !";
                } else {
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "File uploaded with success !";
                }
            } else {
                echo "File is too big.";
            }
        } else {
            echo "Error while uploading.";
        }
    } else {
        echo "Bad file extension.";
    }
}
?>

<a href="profile.php">retour</a>