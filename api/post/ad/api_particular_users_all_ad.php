<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_particular_users_all_ad.php';

    // Instantiate DB & connect
    $database = new Database(); 
    $db = $database->connect(); 

    // Instantiate blog post object
    $post = new model_particular_users_all_ad($db);

    // Get raw posted data
    $data = json_decode(file_get_contents('php://input'), true);
    $email = 'e';

    $result = $post->read($email);
    

    echo json_encode(
        $result
    );

