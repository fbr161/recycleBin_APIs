<?php

 class sign_in_model{
     private $conn;
     private $table = 'user_id';


     public function __construct($db){
         $this->conn = $db;
     }

     //get post
     public function read($query){

         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         return $stmt;
     }

     public function signIn($email, $pass){

         $query = 'SELECT email, pass FROM '
             . $this->table
             . ' WHERE email="' . $email. '" AND pass="' . $pass . '";';

         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         if($stmt->rowCount()>0){return true;}

         return false;
     }

    }
