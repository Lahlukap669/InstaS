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
        <form id="searchForm" action="search.php" method="post">
            <input class="nav-link" type=text name="search" id="search" placeholder="Search">
            <input id="submitForm" type="submit" style="display: none;">
        </form>
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
  $('#searchForm').submit();//text('Event last fired @ ' + (new Date().toUTCString()));
});
</script>