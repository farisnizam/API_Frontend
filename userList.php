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

    if($_SESSION["role"] == "user") {
		header("Location:index.php");
	}

	if(!isset($_SESSION["id"])) {
		header("Location:login.php");
	} else {

        $role = $_SESSION["role"];

        $api_url = 'http://127.0.0.1:8000/api/students';

        // Read JSON file
        $json_data = file_get_contents($api_url);
        
        // Decode JSON data into PHP array
        $results = json_decode($json_data);
    }   
	// if (isset($_GET['message'])){
	// 	echo "<div class='alert alert-sucess'>";
	// 	echo $_GET['message']."</div>";
	// }
	
		
	?>
<div class="container-fluid">

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

	<a href="addUser.php">Add New User</a>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone No</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $result): ?>
				<tr>
					<th><?php echo $result->id;?></th>
					<th><?php echo $result->name;?></th>
					<th><?php echo $result->email;?></th>
					<th><?php echo $result->phone_no;?></th>
					
					<th>
						<form action ="userProfile.php" method="post">
							<button type="submit" name="user_id" value="<?php echo $result->id ?>">View</button>
						</form>
					</th>

				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

</div>
  </body>
</html>