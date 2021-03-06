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
        header("Location:index.php");
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
        <div class="card text-center" style="width: 18rem;margin:auto;">
            <div class="card-body">
                <h1><?php echo $result->name ?></h1>
                <p><?php echo $result->email ?></p>
                <p><?php echo $result->phone_no ?></p>
                <div class="row">
                    <div class="col">
                        <form action ="updateProfile.php" method="get">
                            <button type="submit" name="user_id" value="<?php echo $result->id ?>">Edit</button>
                        </form>
                    </div>
        <?php
                    if ($role == "superadmin") {
        ?>
                    <div class="col">
                        <form action ="deleteUser.php" method="post">
                            <button type="submit" name="user_id" value="<?php echo $result->id ?>">Delete</button>
                        </form>
                    </div>
        <?php	
                    }
        ?>           
                </div>
            </div>
        </div>
    </div>
</div>

</div>


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