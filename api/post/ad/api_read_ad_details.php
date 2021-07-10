<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_read_ad_details.php';

    // Instantiate DB & connect
    $database = new Database(); 
    $db = $database->connect(); 

    // Instantiate blog post object
    $post = new model_read_ad_details($db);

    // Get raw posted data
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $_POST['id'];

    $result = $post->read($id);
    

    echo json_encode(
        $result
    );

