<?php

    class model_particular_users_all_ad{
        private $conn;
        private $table = 'ad';
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
                return $data['name'];
            }
            return;
        }

        private function read_info($email){

            $query = "SELECT * 
                    FROM ad as a JOIN user_id as u ON a.owners_email = u.email
                    WHERE u.email = '$email'";
            
            $rslt = $this->xcute($query);


            $data = array();
            foreach($rslt as $result){

                $jf['id']  = $result['id'];
                $jf['owners_email']  = $result['owners_email'];
                $jf['category']  = $result['category'];
                $jf['city']  = $result['city'];
                $jf['local_area']  = $result['local_area'];
                $jf['description']  = $result['description']; 
                $jf['price']  = $result['price'];
                $jf['product_name']  = $result['product_name'];
                $jf['phone_no']  = $result['phone_no'];
                $jf['date_time']  = $result['date_time'];
                $jf['image_path']  = $result['image_path'];
                $jf['status']  = $result['status'];
               
                array_push($data, $jf);
            }

            return $data;

        }

        public function read($email){

            $data = $this->read_info($email);

            return $data;

        }

    }

    


?>
