<?php
include_once("database.php");
function result($src){
    $result = mysqli_query($con,"SELECT ime, priimek FROM users WHERE ime='%$src%' or priimek='%$src%'") or die(mysqli_error($con));
    $all = mysqli_fetch_all($result);
    foreach($all as &$i){            
        $_REQUEST['search'] = $i[0]." ".$i[1];  
    }
mysqli_close($con);}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/head.css">
        <link rel="shortcut icon" type="image/png" href="images/logo-title.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="false" aria-label="Tooglenavigation">
<span class="navbar-toggler-icon"></span></button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a class="navbar-brand" href="index.php"><img src="images/homeh.png"></a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <input class="nav-link" type=text name="search" id="search" placeholder="Search">
            <p id="search-output"></p>
        </li>
        <li class="nav-item">
            <a class="nav-link products" href="discover.php"><img src="images/discoverh.png"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link products" href="discover.php"><img class="nav-link" src="images/trackingh.png"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link form" href="profile.php"><img src="images/profileh.png"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link products" href="edit.php">edit</a>
        </li>
    </ul>
</div>
</nav>
        <!--<div class="menu">
            <form>
                <ul>
                    <li><a href="index.php" class="home"><img src="images/homeh.png"></a></li>
                    <li><input type=text name="search" id="search" placeholder="Search"></li>
                    <li><a href="discover.php" class="products"><img src="images/discoverh.png"></a></li>
                    <li class="showhim"><img src="images/trackingh.png"><img class="showme" src="images/trackingp.png"></li>
                    <li><a href="profile.php" class="form"><img src="images/profileh.png"></a></li>
                    <li><a href="edit.php" class="products">edit</a></li>
                </ul>
            </form>
        </div>-->
        
    </body>
   
</html>
<script>
//https://stackoverflow.com/questions/14042193/how-to-trigger-an-event-in-input-text-after-i-stop-typing-writing/28695011
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
//<script type="text/javascript" src="js/search.js">
;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

$('#search').donetyping(function(){
    var x = $('#search').value;
    type: "POST",
    url: 'head.php',
    dataType: 'json',
    data: {functionname: 'result', arguments: [x]},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      yourVariable = obj.result;
                  }
                  else {
                      console.log(obj.error);
                  }
            }
  //$('#search-output').text(new Date().toUTCString());
});
	</script>