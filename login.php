<?php
    require_once "config.php";

	if (isset($_SESSION['user'])) {
		header('Location: index.php');
		exit();
    }
    $_SESSION['salt'] = "hrbcooinpu66824z9n";
    
    /*if ($_SESSION["error"]!=""){
        echo '<script type="text/javascript">alert('.$_SESSION["error"].');</script>';
    }*/
    echo $_SESSION["error"];

	$loginURL = $gClient->createAuthUrl();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login With Google</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
    <div class="container" class="container">
        <div class="row justify-content-center bgcolor">
            <div class="col-md-6 col-offset-3" align="center">

                <img src="images/logo.png" class="loginimage"><br><br>

                <form  action="/login_process.php" method="post">
                    <input placeholder="Email..." name="email" class="form-control"><br>
                    <input type="password" placeholder="Password..." name="password" class="form-control"><br>
                    <input type="submit" value="Log In" class="btn btn-primary">
                    <button type="button" class="btn btn-primary"><a href="register.php" class="white nodec">Register</a></button>
                    <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-danger">   
                </form>

            </div>
        </div>
    </div>
</body>
</html>