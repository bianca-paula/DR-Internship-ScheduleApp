<?php
    include_once('../utils/DBConfiguration.php');
    class Room {

        private int $id;
        private string $name;
        private int $capacity;
        function __construct(int $id, string $name, int $capacity){
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;   
        }

        public function getID(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }
        
        public function setName(string $name){
            $this->name=$name;
        }

        public function getCapacity(){
            return $this->capacity;
        }
        
        public function setcapacity(int $capacity){
            $this->capacity=$capacity;
        }
    }
?>