<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
  </head>
  <body>
	<?php
    session_start();

    if(isset($_SESSION["id"])) {
        header("Location:index.php");
    } 
    else {
        if(count($_POST)>0) {
            // Get data from form
            $name=$_POST['name'];
            $email=$_POST['email'];
            $phone_no=$_POST['phone_no'];
            $password= md5($_POST['password']);

            
            // Save new user
            $url = 'http://127.0.0.1:8000/api/student';
            $data = array("name" => $name,"email" => $email,"phone_no" => $phone_no,"password" => $password);

            $postdata = json_encode($data);

            $ch = curl_init($url); 
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec($ch);
            curl_close($ch);
            print_r ($result);
            
            $result = json_decode($result);
            $user_id = $result->id;
            echo $user_id;

            $api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

            // Read JSON file
            $json_data = file_get_contents($api_url);
            
            // Decode JSON data into PHP array
            $user_data = json_decode($json_data);


            // Session data
            if(isset($user_data)) {
                $_SESSION["id"] = $user_data->id;
                $_SESSION["name"] = $user_data->name;
                $_SESSION["role"] = $user_data->role;
            } else {
                $message = "Invalid Username or Password!";
            }

            header("Location:index.php");
        }
        // Redirect
        // if(isset($_SESSION["id"])) {
        //     if($_SESSION["role"] == "admin") {
        //         // header("Location:search-admin.php");
        //         echo " admin";
        //     } else if ($_SESSION["role"] == "user"){
        //         header("Location:index.php");
        //         echo " user";
        //     }
        
        // }

    }

    // header("Location: index.php?message=New+student+$name+saved");

	?>
    <div class="container">
        <form action ="" method="post">
            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Name:</div>
                <div class="col-2 align-self-center"><input type="text" name="name" required></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Email:</div>
                <div class="col-2 align-self-center"><input type="email" name="email" required></div>
            </div>    

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Phone No:</div>
                <div class="col-2 align-self-center"><input type="text" name="phone_no" required></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Password:</div>
                <div class="col-2 align-self-center"><input type="text" name="password" required></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-4 align-self-center"><button type="submit" >Add User</button></div>
            </div>
        </form>
    </div>
  </body>
</html>