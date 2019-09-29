<?php
	include_once("head.php");
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit();
	}
?>

<?php
	include_once("database.php");
	$username = $_SESSION['user'];
	$post = mysqli_query($con,"SELECT u.profile_picture, u.ime, u.priimek, p.slika_url FROM users u
								LEFT OUTER JOIN posts p ON  u.id=p.user_id
								LEFT OUTER JOIN lajki l ON p.id=l.post_id
								WHERE u.email <> '$username'
								ORDER BY p.datum DESC") or die(mysqli_error($con). " errorcic ");
	$all = mysqli_fetch_all($post);
	
    foreach($all as &$i){            
            echo '<div><img src="'.$i[0].'"> '.$i[1]." ".$i[2].' <br><img style="width:100;height:auto;" src="'.$i[3].'"></div>';  
    }
    mysqli_close($con);
?>