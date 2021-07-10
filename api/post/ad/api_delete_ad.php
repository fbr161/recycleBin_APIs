<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_delete_ad.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new model_delete_ad($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (isset($_POST["id"])){
        $id = $_POST["id"];

        if ($post->delete($id)){
            
            header("location: ../../browse_file/ad/delete_status.php");
        } else {
            
            header("location: ../../browse_file/home.php");
        }
    }else{
        echo json_encode(
            array('signUp' => 'failed')
        );
    }

    