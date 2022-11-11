<?php
    include_once('../utils/DBConfiguration.php');
    class Course {

        private int $id;
        private string $name;
        private string $type;
        function __construct(int $id, string $name, string $type){
            $this->id = $id;
            $this->name = $name;
            $this->type = $type;   
        }

        public function getID(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }
        
        public function setName($name){
            $this->name=$name;
        }

        public function getType(){
            return $this->type;
        }
        
        public function setType($type){
            $this->type=$type;
        }
    }
?>