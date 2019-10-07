<?php
	include_once("config.php");
	/*if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit();
	}*/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login With Google</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-3">
			<img style="width: 80%;" src="<?php echo $_SESSION['picture']; ?>">
		</div>

		<div class="col-md-9">
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td>ID</td>
						<td><?php if(isset($_SESSION['gid'])){echo $_SESSION['gid'];} ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><?php if(isset($_SESSION['givenName'])){ echo $_SESSION['givenName'];} ?></td>
					</tr>
					<tr>
						<td>Surname</td>
						<td><?php if(isset($_SESSION['familyName'])){ echo $_SESSION['familyName'];} ?></td>
					</tr>
					<tr>
						<td>Date of birth</td>
						<td><?php if(isset($_SESSION['date'])){ $date = date ("d-m-Y", strtotime($_SESSION['date'])); echo $date;} ?></td>
					</tr>

				</tbody>
			</table>
			<a href="edit_propic.php">edit profile picture</a>
			<br><a href="logout.php">logout</a>
		</div>
	</div>
</div>
</body>
</html>