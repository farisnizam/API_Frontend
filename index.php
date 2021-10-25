<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
	<?php
	session_start();

	if(!isset($_SESSION["id"])) {
		header("Location:login.php");
	} else {

	$user_id = $_SESSION["id"];
    $role = $_SESSION["role"];

	$api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

	// Read JSON file
	$json_data = file_get_contents($api_url);
	
	// Decode JSON data into PHP array
	$result = json_decode($json_data);

	}
	?>


<div class="container-fluid">
<!-- <a href="profile.php"> Profile</a> -->
<div>
	<a href="logout.php" style="float:right;"> Logout</a>
    <a href="index.php" style="float:right;margin-right: 12px;"> Home</a>

<?php
if ($role !== "user") {
?>
	<a href="userList.php" style="float:right;margin-right: 12px;">User List</a>
<?php	
}
?>
</div>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Phone No</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $result->name ?></td>
				<td><?php echo $result->email ?></td>
				<td><?php echo $result->phone_no ?></td>
				<td>
					<button type="submit" name="user_id" ><a href="profile.php" style="text-decoration: none;color:black;"> Profile</a></button>
				</td>
			</tr>
		</tbody>
	</table>
</div>

</body>
</html>