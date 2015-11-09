<?php

$uname = $email = $phone = $file ="";
$error = $_GET['error'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link href="./bootstrap.min.css" rel="stylesheet">


	<link href="./etango.css" rel="stylesheet">
</head>

<body>

<h1>Welcome to Elton PHP website submission of User Info and Images.</h1>

<form enctype="multipart/form-data" action="submit.php" method="POST">    
    
	<label >User Name:</label>
	<input class="form-control" type="text" name="uname" value="<?php echo isset($_POST['uname']) ? $_POST['uname'] : '' ?>"></input><br><br>
	<label >Email Address:</label>
	<input class="form-control" type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"></input><br><br>
	<label >Phone (1-XXX-XXX-XXXX):</label>
	<input class="form-control" type="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>"></input><br><br>
	<label >File to send:</label>
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	<input  type="file" name="file" value="<?php echo isset($_POST['file']) ? $_POST['file'] : '' ?>"></input><br><br>
	<button type="submit" class="btn btn-default">Send File</button>
	<input type="hidden" name="submit"/><br><br><br><br>
</form>

<footer class='footer'>
<form enctype="multipart/form-data" action="gallery.php" method="POST">
    
Enter Email of user for gallery to browse: <input type="email" name="email">
<input type="submit" value="Load Gallery" />
</form>
</footer>

</div>
</body>
</html>
