<?php
    session_start();
    require_once("database.php");

        $f_id = $_GET["f_id"];
        $u_id = $_GET["u_id"];

         mysqli_query($con,"DELETE FROM followers WHERE follower_id='$u_id' AND followed_id='$f_id';")
                            or die("failed to query database"); 
        
        mysqli_close($con);           
        header("Location: discover.php");
        exit();
        
?>