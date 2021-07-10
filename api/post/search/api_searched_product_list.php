<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_searched_product_list.php';

    // Instantiate DB & connect
    $database = new Database(); 
    $db = $database->connect(); 

    // Instantiate blog post object
    $post = new model_searched_product_list($db);

    // Get raw posted data
    $data = json_decode(file_get_contents('php://input'), true);
    // $key = 's';
    $key = $_POST['key'];

    $result = $post->read($key);
    

    echo json_encode(
        $result
    );

