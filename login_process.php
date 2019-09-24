<?php
    session_start();
    require "database.php";
    
    $username = $_POST['email'];
    $password = $_POST['password'];

    $username = stripslashes($username);
    $password = stripslashes($password);
    $password = sha1($password.$_SESSION['salt']);
    $result = mysqli_query($con,"SELECT * FROM users WHERE email='$username' and geslo='$password'") 
                or die(mysqli_error());

    /*if(!mysql_num_rows($result)){
        $message = "your email isn't registerd yet!";
    }*/
    $_SESSION['error'] = mysqli_error($con);

    $row = mysqli_fetch_array($result);

    $_SESSION["user"] = $row['email'];
    $_SESSION["pass"] = $row['geslo'];

    if (mysqli_num_rows($result) > 0){
        echo "login success! ".$row['email'];
        $_SESSION['user'] = $username;
        $_SESSION['id'] = $row['id'];
        $_SESSION['user-name'] = $row['ime'];
        $_SESSION['user-surname'] = $row['priimek'];+
        //echo "<br>".$_SESSION['user'];
        header('Location: index.php');
        $_SESSION['error'] = "";
        exit;  
    }
    else{
        $_SESSION['error'] = "Username or password incorrect!";
        header('Location: login.php');
        
        exit;
    }
    mysqli_close($con);
    header("Location: index.php");
?>