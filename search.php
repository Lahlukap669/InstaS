<?php
    include_once('head.php');
    include_once("database.php");
?>
<div>
<?php
//<div id="search-el" class="d-flex flex-column">
    $src = $_POST['search'];
    $result = mysqli_query($con,"SELECT ime, priimek, id FROM users WHERE LOWER(ime) LIKE LOWER('%$src%') or LOWER(priimek) LIKE LOWER('%$src%')") or die(mysqli_error($con));
    $all = mysqli_fetch_all($result);
    foreach($all as &$i){            
            echo '<div><a class="post-user-link" href="profile.php?id='.$i[2].'">'.$i[0]." ".$i[1]."</a></div>";  //class="p-2"
    }
    mysqli_close($con);
?>
</div>