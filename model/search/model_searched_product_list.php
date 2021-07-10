
<?php

    class model_searched_product_list{
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


        private function read_info($key){

            $query = "SELECT * FROM `ad` WHERE ad.status = 0";
            
            $rslt = $this->xcute($query);

            
            $data = array();
            foreach($rslt as $result){
                
                foreach (explode(" ",$key) as $slice){
                    $pattern = "/$slice/i";

                    if(preg_match($pattern, $result['category']) || preg_match($pattern, $result['description']) || preg_match($pattern, $result['product_name']) ){

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
                }
                

            }

            return $data;

        }

        public function read($key){

            $data = $this->read_info($key);

            return $data;

        }

    }

    


?>
