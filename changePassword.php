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
$message="";

if(!isset($_SESSION["id"])) {
    header("Location:login.php");
} else {
    $role = $_SESSION["role"];

    if(count($_POST)>0) {
        $user_id = $_POST['user_id'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $retype_password = md5($_POST['retype_password']);

        $role = $_SESSION["role"];

        $api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

        // Read JSON file
        $json_data = file_get_contents($api_url);
            
        // Decode JSON data into PHP array
        $result = json_decode($json_data);

        $name=$result->name;
        $email=$result->email;
        $phone_no=$result->phone_no;
        $password=$result->password;

        if ($old_password == $password) {
            echo "betul";
            if ($new_password == $retype_password) {

                $url = 'http://127.0.0.1:8000/api/studentupdate/'.$user_id;


                $data = array("name" => $name,"email" => $email,"phone_no" => $phone_no,"password" => $new_password);
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

                header("Location: index.php?message=Password changed successfully");
            } else {
                $message = "Invalid Retype Password";
            }
        } else {
            $message = "Invalid Old Password";
        }
        
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
        <div class="row">
            <div class="col-12 mt-5">
                <form action ="" method="post">
                    <div class="row justify-content-center">
                        <div class="col-4 align-self-center text-end message"><?php if($message!="") { echo $message; } ?></div>
                    </div>
                    <div class="row justify-content-center">
                        <input type="hidden" name="password" value="<?php echo $result->password ?>">

                        <div class="col-2 align-self-center"><input type="hidden" name="name" required value="<?php echo $result->name ?>"></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center"><input type="hidden" name="email" required value="<?php echo $result->email ?>"></div>
                    </div>    

                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center"><input type="hidden" name="phone_no" required value="<?php echo $result->phone_no ?>"></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center">Old Password:</div>
                        <div class="col-2 align-self-center"><input type="password" name="old_password" required></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center">New Password:</div>
                        <div class="col-2 align-self-center"><input type="password" name="new_password" required></div>
                    </div>    

                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center">Retype Password</div>
                        <div class="col-2 align-self-center"><input type="password" name="retype_password" required></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-4 align-self-center"><button type="submit" name="user_id" required value="<?php echo $result->id ?>">Update Password</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>