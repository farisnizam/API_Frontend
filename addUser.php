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
    // $user_id=$_POST['user_id'];

	// $api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

	// Read JSON file
	// $json_data = file_get_contents($api_url);
	
	// // Decode JSON data into PHP array
	// $result = json_decode($json_data);

	?>
    <div class="container">
        <form action ="saveUser.php" method="post">
            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Name:</div>
                <div class="col-2 align-self-center"><input type="text" name="name"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Email:</div>
                <div class="col-2 align-self-center"><input type="email" name="email"></div>
            </div>    

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Phone No:</div>
                <div class="col-2 align-self-center"><input type="text" name="phone_no"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Password:</div>
                <div class="col-2 align-self-center"><input type="text" name="password"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-4 align-self-center"><button type="submit" >Add User</button></div>
            </div>
        </form>
    </div>
  </body>
</html>