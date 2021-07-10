<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/sign_in_model.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new sign_in_model($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (isset($_POST["email"], $_POST['pass'])){
        $email = $_POST["email"];
        $password = $_POST["pass"];

        if ($post->signIn($email, $password)){
            // echo json_encode(
            //     array('signIn' => $email)
            // );
            session_start();
            $_SESSION["email"] = $email;

            header("location: ../../../HomePage/homepage.php");
        } else {
            // echo json_encode(
            //     array('signIn' => 'failed')Sign-In-And-Sign-Up\Sign-In-Page\sign_in.php
            // );
            header("location: ../../../Sign-In-And-Sign-Up/Sign-In-Page/sign_in.php");
        }
    }else{
        echo json_encode(
            array('signUp' => 'failed')
        );
    }
