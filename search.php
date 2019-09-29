<?php
    include_once('head.php');
    include_once("database.php");
?>
<div id="search-el" class="d-flex flex-column">
<?php
    $src = $_POST['search'];
    $result = mysqli_query($con,"SELECT ime, priimek FROM users WHERE LOWER(ime) LIKE LOWER('%$src%') or LOWER(priimek) LIKE LOWER('%$src%')") or die(mysqli_error($con));
    $all = mysqli_fetch_all($result);
    foreach($all as &$i){            
            echo '<div class="p-2">'.$i[0]." ".$i[1]."</div>";  
    }
    mysqli_close($con);
?>
</div>