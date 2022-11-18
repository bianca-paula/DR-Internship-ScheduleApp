<?php

class User {
    // Properties
    private $id;
    private $email;
    private $password;
    private $first_name;
    private $last_name;
    private $prefix;
    
    // Constructor
    function __construct($id, $email,$password, $first_name, $last_name, ?string $prefix){
            
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->prefix = $prefix;
            
    }
    
    
    // Getters and Setters
    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }
    function get_email() {
        return $this->email;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_first_name($first_name) {
        $this->first_name = $first_name;
    }
    function get_first_name() {
        return $this->first_name;
    }
    function set_last_name($last_name) {
        $this->last_name = $last_name;
    }
    function get_last_name() {
        return $this->last_name;
    }
    function set_prefix($prefix) {
        $this->prefix = $prefix;
    }
    function get_prefix() {
        return $this->prefix;
    }
    
    
    
}


?>