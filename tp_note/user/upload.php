<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: index.php');
}
$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
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