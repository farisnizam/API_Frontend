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

	// if (isset($_GET['message'])){
	// 	echo "<div class='alert alert-sucess'>";
	// 	echo $_GET['message']."</div>";
	// }

	$api_url = 'http://127.0.0.1:8000/api/students';

	// Read JSON file
	$json_data = file_get_contents($api_url);
	
	// echo $json_data;
	// Decode JSON data into PHP array
	$results = json_decode($json_data);
		
	?>
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
						<form action ="profile.php" method="post">
							<button type="submit" name="user_id" value="<?php echo $result->id ?>">View</button>
						</form>
					</th>

				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>