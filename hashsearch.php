<div>
<?php
include_once("database.php");
include_once("head.php");

$hash = $_GET['hash'];
if (strpos($hash, ",") !== false) {
    $allhashes = explode(",", $hash);
$allhashtags = [];

foreach($allhashes as &$i){
    array_push($allhashtags, "#".$i);
}
}else{$allhashtags = []; array_push($allhashtags, "#".$hash);}



$posts = mysqli_query($con,"SELECT u.id, p.id, p.naslov, p.opis, p.slika_url FROM users u INNER JOIN posts p ON u.id=p.user_id") or die(mysqli_error($con). " errorcic ");
$all = mysqli_fetch_all($posts);

foreach($all as &$i){
    $opis = $i[3];
    foreach($allhashtags as &$h){
        $hit = [];
        if (strpos($opis, $h) !== false) {
            array_push($hit, $h);
        }
    }
    if(!empty($hit)){
        echo '<div class="alert alert-dark scale80 posc" role="alert"><img class="post-user-icon-lg discoverimg" src="'.$i[4].'" alt="user-profile-img"><a class="post-user-link" href="comments.php?p_id='.$i[1].'&u_id='.$i[0].'">'.$i[2]."  </a>";
        foreach($hit as &$t){echo "<a class='badge badge-info floatr followbtn'>".$t."</a>";}
        echo'</div>';
    }
}
mysqli_close($con);
?>
</div>