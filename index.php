<?php

$uname = $email = $phone = $file ="";
$error = $_GET['error'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="./etango.css" rel="stylesheet">
</head>

<body>

<h1>Welcome to Elton PHP website submission of User Info and Images.</h1>

<form enctype="multipart/form-data" action="submit.php" method="POST">    
    
	<label >User Name:</label>
	<input class="form-control" type="text" name="uname" value="<?php ($_POST['uname']) ? $_POST['uname'] : '' ?>"></input>
	<br/>
	<label >Email Address:</label>
	<input class="form-control" type="email" name="email" value="<?php ($_POST['email']) ? $_POST['email'] : '' ?>"></input>
	<br/>
	<label >Phone :</label>
	<input class="form-control" type="phone" name="phone" value="<?php ($_POST['phone']) ? $_POST['phone'] : '' ?>"></input>
	<br/>
	<label >File to send:</label>
	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
	<input  type="file" name="file" value="<?php ($_POST['file']) ? $_POST['file'] : '' ?>"></input><br><br>
	<button type="submit">Send File</button>
	<input type="hidden" name="submit"/>
	<br/>
</form>



</div>
</body>
</html>
