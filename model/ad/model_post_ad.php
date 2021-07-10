<?php

    class model_post_ad{
        private $conn;
        private $table = 'ad';
        private $id_table = 'user_info';


        public function __construct($db){
            $this->conn = $db;
        }

        //get post
        private function xcute($query){

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        private function get_ad_id($email){
            $query = "SELECT total_given_ad FROM `user_info` WHERE email='$email'";
            $result = $this->xcute($query);

            $data = array();
            foreach($result as $rslt){
                $data['total_given_ad'] = $rslt['total_given_ad'];
            }

            $num = (int)$data['total_given_ad'] + 1;
            $q = "UPDATE `user_info` SET `total_given_ad` = '$num' WHERE `user_info`.`email` = '$email';";
            $this->xcute($q);

            return $email.$data['total_given_ad'];

        }

        private function upload_img($file, $file_name){

            $errors= array();
            //$file_name = $file['image']['name'];
            $file_size =$file['image']['size'];
            $file_tmp =$file['image']['tmp_name'];
            $file_type=$file['image']['type'];
            $tmp = explode('.',$file['image']['name']);
            $file_ext=strtolower(end($tmp));

            $extensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"imgAd/".$file_name.".jpg");
                return true;
            }else{
                print_r($errors);
                return false;
            }
            

        }
        

        public function post($owner_email, $product_name, $category, $city, $local_area, $description, $price, $phone_no, $file){

            $id = $this->get_ad_id($owner_email);
            $image_path = "imgAd/".$id.".jpg";
            $date = date('Y/m/d H:i:s');

            $query = "INSERT INTO ".$this->table." (`owners_email`, `category`, `city`, `local_area`, `description`, `price`, `product_name`, "
                    ."`phone_no`, `date_time`, `image_path`, `status`) VALUES ( '$owner_email', '$category', '$city', '$local_area', '$description', "
                    ."'$price', '$product_name', '$phone_no', '$date', '$image_path', b'0');";

            $stmt = $this->conn->prepare($query);

            if( $stmt->execute() &&  $this->upload_img($file, $id)){
                return true;
            }else{
                return false;
            }

        }



    }

    


?>
