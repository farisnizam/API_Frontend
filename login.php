<?php
session_start();
$message="";

if(isset($_SESSION["id"])) {
	header("Location:index.php");
} else {
	if(count($_POST)>0) {
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		$url = 'http://127.0.0.1:8000/api/login';
		$data = array("username" => $username,"password" => $password);
	
		$postdata = json_encode($data);
	
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);
		curl_close($ch);
		// print_r ($result);
		
		// Decode JSON data into PHP array
		$user_data = json_decode($result);
	
		// Session data
		// Check if user data is not empty
		$dataStatus = get_object_vars($user_data) ? TRUE : FALSE;
	
		if ($dataStatus == TRUE) {
			$_SESSION["id"] = $user_data->id;
			$_SESSION["name"] = $user_data->name;
			$_SESSION["role"] = $user_data->role;

			$message = "Login Success";
	
			header("Location:index.php");
		} else {
			$message = "Invalid Username or Password!";
		}
		
	}
}


// if(isset($_SESSION["id"])) {
// 	echo "ada tk";
// 	if($_SESSION["role"] == "admin") {
// 		header("Location:search-admin.php");
// 	} else if ($_SESSION["role"] == "user"){
// 		header("Location:index.php");
// 	}

// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<a href="register.php">New User</a>
		<div class="mx-auto mt-5" style="width: 30%;">
			<h2>Login Form</h2>

			<form action="" method="POST">
				<div class="message"><?php if($message!="") { echo $message; } ?></div>
				<label>User Name:</label><br>
				<input class="form-control" type="text" name="username">
				<br>
				<label>Password:</label><br>
				<input class="form-control" type="password" name="password">
				<br>
				<br>
				<input class="form-control btn btn-primary" type="submit" value="submit">
			</form>
		</div>
	</div>

</body>
</html>