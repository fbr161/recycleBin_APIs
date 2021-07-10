<?php

    class model_read_ad_details{
        private $conn;


        public function __construct($db){
            $this->conn = $db;
        }

        //get post
        private function xcute($query){

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }


        private function read_info($id){

            $query = "SELECT * FROM ad as a JOIN user_id as u ON u.email=a.owners_email
                        WHERE id = '$id'";
            
            $rslt = $this->xcute($query);


            $data = array();
            foreach($rslt as $result){

                $jf['id']  = $result['id'];
                $jf['user_name']  = $result['name'];
                $jf['owners_email']  = $result['owners_email'];
                $jf['category']  = $result['category'];
                $jf['city']  = $result['city'];
                $jf['local_area']  = $result['local_area'];
                $jf['description']  = $result['description']; 
                $jf['price']  = $result['price'];
                $jf['product_name']  = $result['product_name'];
                $jf['phone_no']  = $result['phone_no'];
                $jf['date_time']  = date($result['date_time']);
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
