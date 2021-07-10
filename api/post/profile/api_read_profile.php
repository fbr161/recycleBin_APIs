<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_read_profile.php';

    // Instantiate DB & connect
    $database = new Database(); 
    $db = $database->connect(); 

    // Instantiate blog post object
    $post = new model_read_profile($db);

    // Get raw posted data
    $data = json_decode(file_get_contents('php://input'), true);
    
    $result = $post->read($data["email"]);
    
    if (!empty($data)){
        echo json_encode(
            $result
        );
    } else {
        echo json_encode(
            array('status' => 'failed')   
        );
    }

    //if (isset($_POST["email"] )){
        //$email = $_POST['email'];

        // $data1 = $post->read($data["email"]);

        // if (!empty($data1)){
        //     echo json_encode(
        //         $data1
        //     );
        //     //header("location: ../../browse_file/user/profile.php");
        //     //print_r($data);
        // } else {
        //     echo json_encode(
        //         array('signIn' => 'failed')   
        //     );
        //     //echo "failed  dssdv";

        // }
    // }else{
    //     echo json_encode(
    //         array('signUp' => 'failed')
    //     );

    //     //echo "\$_post failed";
    // }

