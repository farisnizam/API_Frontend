<?php
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone_no=$_POST['phone_no'];
    $password=$_POST['password'];
    
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

    header("Location: index.php?message=New+student+$name+saved");

	// $api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

    // "http://127.0.0.1:8000/api/studentupdate/1?name=Muhammad&email=muhammad@gmail.com&phone_no=011222&password=123"
?>