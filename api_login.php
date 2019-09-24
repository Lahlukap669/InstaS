<?php
    session_start();
    require "database.php";
    $g_id = $_SESSION['gid'];
    $email = $_SESSION['email'];
    $result = mysqli_query($con,"SELECT * FROM users WHERE email='$email' or google_auth_id='$g_id'") 
                or die(mysqli_error($con));

    $username = $_SESSION['email'];
    $profpic = $_SESSION['picture'];
    $surname = $_SESSION['familyName'];
    $name = $_SESSION['givenName'];
    $datum = $_SESSION['date'];

    $row = mysqli_fetch_array($result);
    if(!mysqli_num_rows($result)){
        
        $message = "your email isn't registerd yet!";
        mysqli_query($con,"INSERT INTO users (google_auth_id, ime, priimek, email, datum_r, profile_picture) Values ('$g_id', '$name', '$surname', '$username', '$datum', '$profpic')")
                            or die(mysqli_error($con));
    }

    $row = mysqli_fetch_array($result);

    if((mysqli_num_rows($result) > 0)){
        echo "login success! ".$row['email'];
        $_SESSION['user'] = $username;
        $_SESSION['id'] = $row['id'];
        $_SESSION['user-name'] = $row['ime'];
        $_SESSION['user-surname'] = $row['priimek'];+
        //echo "<br>".$_SESSION['user'];
        header('Location: index.php');
        $_SESSION['error'] = mysqli_error();
        exit;  
    }

    mysqli_close($con);
    header("Location: index.php");
?>