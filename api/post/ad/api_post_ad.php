<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_post_ad.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new model_post_ad($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    session_start();

    if (isset($_SESSION["email"], $_POST['product_name'], $_POST['category'], $_POST['city'], $_POST['local_area'],  $_POST['description'],  $_POST['price'],  $_POST['phone_no'],  $_FILES['image'] )){
        $owner_email = $_SESSION["email"];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $city = $_POST['city'];
        $local_area = $_POST['local_area'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $phone_no = $_POST['phone_no'];



        if ($post->post($owner_email, $product_name, $category, $city, $local_area, $description, $price, $phone_no, $_FILES)){
            // echo json_encode(
            //     array('signIn' => $email)
            // );
            header("location: ../../../HomePage/ad/post_ad_status.php");
        } else {
            // echo json_encode(
            //     array('signIn' => 'failed')
            // );
            echo "failed";

        }
    }else{
        // echo json_encode(
        //     array('signUp' => 'failed')
        // );

        echo "\$_post failed";
    }
