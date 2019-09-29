<?php
    session_start();
    require_once("database.php");

    if (!filter_input(INPUT_GET, "name", FILTER_VALIDATE_REGEXP) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_VALIDATE_REGEXP) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_VALIDATE_REGEXP) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_VALIDATE_REGEXP) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_VALIDATE_REGEXP) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    
    if (!filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    if (!filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) === false) {
        echo("Email is valid");
    }else{
        header('Location: register.php');
    }
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['email'];
    $password = $_POST['password'];
    $datum = $_POST['datum_r'];
    $repassword = $_POST['repassword'];

    if($password == $repassword){

        $username = stripslashes($username);
        $password = stripslashes($password);
        $password = sha1($password.$_SESSION['salt']);

        $result = mysqli_query($con,"SELECT email FROM users") 
                    or die("failed to query database");

        $row = mysqli_fetch_array($result);

        $def_img = "http://cdn.onlinewebfonts.com/svg/img_299586.png";
        if(!in_array($username, $row)){
            echo "register succesful! ".$row['email'];
            mysqli_query($con,"INSERT INTO users (ime, priimek, email, geslo, datum_r, profile_picture) Values ('$name', '$surname', '$username', '$password', '$datum', '$def_img')")
                            or die("failed to query database");
            
            
            header('Location: login.php');
            exit();
        }
        else{
            echo "<>failed to register";
            echo "
            <script type=\"text/javascript\">
            alert(\"errorcic\");
            </script>
        ";
            //header('Location: register.php');
        }

        mysqli_close($con);
    }
?>