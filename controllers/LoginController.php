<?php 

include_once "../helpers/UserHelper.php";

class LoginController{
    private DbConfiguration $db;
    private UserHelper $user_helper;

    public function __construct(){
        $this->db = new DBConfiguration();
        $this->user_helper = new UserHelper($this->db);
    }

    function view(){
        print TemplateEngine::template('./views/login/login.php');
    }

    function login(){
        $email = $_GET['email'];
        $password = $_GET['password'];
        $user =  $this->user_helper->verifyUser($email, $password);

        if (is_null($user)){
            // invalid credentials
            return false;
        }

        // valid credentials
        $role = $this->user_helper->getUserRole($user->id);
        echo json_encode(array('user_id' => $user->id, 'user_role' => $role));
    }






}

?>