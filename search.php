<?php
session_start();
    include_once('head.php');
    include_once("database.php");
?>
<div>
<?php
//<div id="search-el" class="d-flex flex-column">
    $src = $_POST['search'];
    $me_username = $_SESSION['user'];

    $result = mysqli_query($con,"SELECT id FROM users WHERE email='$me_username' LIMIT 1") or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $id = $row['id'];

    $_SESSION["src-word"] = $src;
    $result = mysqli_query($con,"SELECT ime, priimek, id, profile_picture FROM users WHERE LOWER(ime) LIKE LOWER('%$src%') or LOWER(priimek) LIKE LOWER('%$src%')") or die(mysqli_error($con));
    $all = mysqli_fetch_all($result);
    foreach($all as &$i){
        if($i[2]==$id) {continue;}        
        $followed_id = $i[2];
		$followed = mysqli_query($con,"SELECT follower_id FROM followers WHERE followed_id='$followed_id' AND follower_id='$id' LIMIT 1") or die(mysqli_error($con));
		$row = mysqli_fetch_array($followed);
		if( $row==null ){
		echo '<div class="alert alert-dark scale80 posc" role="alert"><img class="post-user-icon-lg discoverimg" src="'.$i[3].'" alt="user-profile-img"><a class="post-user-link" href="profile.php?id='.$i[2].'">'.$i[0]." ".$i[1].'</a> <a href=follow_process.php?f_id='.$i[2].'&u_id='.$id.' class="badge badge-primary floatr followbtn">Follow</a></div>';  //class="p-2"
		}else{
			echo '<div class="alert alert-dark scale80 posc" role="alert"><img class="post-user-icon-lg discoverimg" src="'.$i[3].'" alt="user-profile-img"><a class="post-user-link" href="profile.php?id='.$i[2].'">'.$i[0]." ".$i[1].'</a> <a href=unfollow_process.php?f_id='.$i[2].'&u_id='.$id.' class="badge badge-primary floatr followbtn">Unfollow</a></div>';  //class="p-2"
		}
    }
    mysqli_close($con);
?>
</div>