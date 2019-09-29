<html>
    <head>
<!-- <link rel="stylesheet" type="text/css" href="css/head.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/head.css">
<!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Roboto:100,400,900|Satisfy&display=swap" rel="stylesheet">
    </head>
<!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/196e2f7040.js" crossorigin="anonymous"></script>

<body>
  <div class="container">
  <nav class="navbar navbar-expand-lg navbar-black bg-white">

		 <a class="navbar-brand" href="index.php">
       <img src="images/brand-logo.png" class="d-inline-block align-top brand-img" alt="">
       InstaS</a>
       <form id="searchForm" action="search.php" method="post" class="form-inline">
         <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
       </form>


		 <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
					<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">

					<ul class="navbar-nav ml-auto">
							<li class="nav-item">
									<a class="nav-link" href=""><i class="far fa-compass navbar-icon"></i></a>
							</li>
							<li class="nav-item">
									<a class="nav-link" href=""><i class="far fa-heart navbar-icon"></i></a>
							</li>
							<li class="nav-item">
									<a class="nav-link" href=""><i class="far fa-user navbar-icon"></i></a>
							</li>
					</ul>
			</div>
    </div>
	</nav>
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
  $('#searchForm').submit();
});
</script>
