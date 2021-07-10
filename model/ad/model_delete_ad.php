<?php

    class model_delete_ad{
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

        public function delete($id){

            $query = "DELETE FROM `ad` WHERE `ad`.`id` = '$id';";

            $stmt = $this->conn->prepare($query);

            if( $stmt->execute() ){
                return true;
            }else{
                return false;
            }

        }



    }

    


?>
