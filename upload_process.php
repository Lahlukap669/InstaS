<?php
include_once("database.php");
session_start();
$title = $_POST['title'];
$des = $_POST['des'];
$username = $_SESSION['user'];
$now = date("Y-m-d")."_".date("H:i:s")."_";
$target_dir = "uploads/";
$slika = $target_dir.$now.$_FILES["fileToUpload"]["name"];

$result = mysqli_query($con,"SELECT id FROM users WHERE email='$username';")
                or die(mysqli_error($con));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row["id"];

    /*if(!mysql_num_rows($result)){
        $message = "your email isn't registerd yet!";
    }*/
    $_SESSION['error'] = mysqli_error($con);
echo $_SESSION['error'];
$_FILES["fileToUpload"]["name"] = $now.$_FILES["fileToUpload"]["name"];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    echo "<a href='upload.php'>Back</a>";;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $result = mysqli_query($con,"INSERT INTO posts (filter_id, naslov, opis, slika_url, user_id) VALUES (1, '$title', '$des', '$slika', $id)")
                or die(mysqli_error($con));
        mmysqli_close($con);
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header("Location: index.php");
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
        echo "<a href='upload.php'>Back</a>";
    }
}
header("Location: index.php");
        exit;
//moje stvari
?>