<?php

    class model_read_profile{
        private $conn;
        private $table = 'user_info';
        private $id_table = 'user_id';


        public function __construct($db){
            $this->conn = $db;
        }

        //get post
        private function xcute($query){

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        private function read_name($email){

            $query = "SELECT name FROM ".$this->id_table." WHERE ".$this->id_table.".`email` = '$email';";

            $result = $this->xcute($query);
            $data = array();
            foreach($result as $result){

                $data['name'] = $result['name'];
            }

            return $data['name'];

            // $name = "";
            // while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            //     $name = $row["name"];
            // }

        }

        private function read_info($email){

            $query = "SELECT * FROM ".$this->table." WHERE email='$email'";
            
            $result = $this->xcute($query);

            $data = array();
            foreach($result as $result){

                $data['address']  = $result['address'];
                $data['description']  = $result['description'];
                $data['phone_no']  = $result['phone_no'];
                $data['profile_photo']  = $result['profile_photo'];
               
            }

            return $data;

        }

        public function read($email){

            $data = $this->read_info($email);
            $data['name'] = $this->read_name($email);

            return $data;

        }

    }

    


?>
