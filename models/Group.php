<?php


class Group{
    // Properties
    private $id;
    private $name;
    private DbConfiguration $db_config;
    
    // Constructor
    function __construct(string $name){
            
            $this->name = $name;
            
    }
    
    
    // Getters and Setters
    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    
    
}

?>








