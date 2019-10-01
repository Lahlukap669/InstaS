<?php
    session_start();
    require_once("database.php");

        $u_id_p = $_SESSION['user_post'];
        $username = $_SESSION['user'];

        $result = mysqli_query($con,"SELECT id FROM users WHERE email='$username' LIMIT 1") 
                    or die("failed to query database");

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $u_id = $row["id"];
        $komentar = $_POST['searchc'];
        $p_id = $_SESSION['p_id'];

         mysqli_query($con,"INSERT INTO komentarji (komentar, post_id, user_id) Values ('$komentar', '$p_id', '$u_id')")
                            or die("failed to query database"); 
        
                            header('Location: comments.php?p_id='.$p_id.'&u_id='.$u_id_p);
        exit();
        mysqli_close($con);
?>