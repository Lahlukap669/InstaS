<?php
    session_start();
    require_once("database.php");

        $f_id = $_GET["f_id"];
        $u_id = $_GET["u_id"];

         mysqli_query($con,"INSERT INTO followers (follower_id, followed_id) Values ('$u_id', '$f_id')")
                            or die("failed to query database"); 
        
                            
        header("Location: discover.php");
        exit();
        mysqli_close($con);
?>