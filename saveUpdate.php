<?php
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

	// $api_url = 'http://127.0.0.1:8000/api/student/'.$user_id;

    // "http://127.0.0.1:8000/api/studentupdate/1?name=Muhammad&email=muhammad@gmail.com&phone_no=011222&password=123"
?>