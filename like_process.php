<?php
    session_start();
    require_once("database.php");

        $p_id = $_GET["p_id"];
        $username = $_SESSION['user'];
        
        $result = mysqli_query($con,"SELECT id FROM users WHERE email='$username'")
                            or die("failed to query database"); 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $u_id = $row["id"];

        $result = mysqli_query($con,"SELECT id FROM lajki WHERE user_id='$u_id' AND post_id='$f_id' LIMIT 1")
                            or die("failed to query database"); 
                            $row = mysqli_fetch_array($result);
        if($row == null){
        mysqli_query($con,"INSERT INTO lajki (user_id, post_id) Values ('$u_id', '$f_id')")
                            or die("failed to query database"); 
        
        }                   
        header("Location: index.php");
        exit();
        mysqli_close($con);
?>