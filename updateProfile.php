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

if(!isset($_SESSION["id"])) {
    header("Location:login.php");
} else {

    if(count($_POST)>0) {
        $user_id=$_POST['user_id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone_no=$_POST['phone_no'];
        $password=$_POST['password'];

        
        $url = 'http://127.0.0.1:8000/api/studentupdate/'.$user_id;


        $data = array("name" => $name,"email" => $email,"phone_no" => $phone_no,"password" => $password);
        $data_json  = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        print_r ($response);

        header("Location: index.php?message=New+student+$name+updated");
    }


    $user_id=$_GET['user_id'];

	$api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

	// Read JSON file
	$json_data = file_get_contents($api_url);
	
	// Decode JSON data into PHP array
	$result = json_decode($json_data);
    
}
	?>
    <div class="container">
        <form action ="" method="post">
            <div class="row justify-content-center">
                <!-- <input type="hidden" name="_method" value="PUT"> -->
                <input type="hidden" name="password" value="<?php echo $result->password ?>">
                <div class="col-2 align-self-center">Name:</div>
                <div class="col-2 align-self-center"><input type="text" name="name" required value="<?php echo $result->name ?>"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Email:</div>
                <div class="col-2 align-self-center"><input type="email" name="email" required value="<?php echo $result->email ?>"></div>
            </div>    

            <div class="row justify-content-center">
                <div class="col-2 align-self-center">Phone No:</div>
                <div class="col-2 align-self-center"><input type="text" name="phone_no" required value="<?php echo $result->phone_no ?>"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-4 align-self-center"><button type="submit" name="user_id" required value="<?php echo $result->id ?>">Update</button></div>
            </div>
        </form>
    </div>
  </body>
</html>