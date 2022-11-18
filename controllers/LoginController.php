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
        $error_visibility = 'hidden';
        print TemplateEngine::template('./views/login/login.php', array('error_visibility' => $error_visibility));
    }

    function viewWithError(){
        $error_visibility = 'visible';
        print TemplateEngine::template('./views/login/login.php', array('error_visibility' => $error_visibility));
    }

    function login(){

        session_start();

        if($_SERVER['REQUEST_METHOD']=='GET'
            && !empty($_GET['input_email'])
            && !empty($_GET['input_password'])) {
       
            // will be changed so that it uses a UserHelper class
            $email = $_GET['input_email'];
            $password = $_GET['input_password'];
            $user = $this->user_helper->verifyUser($email, $password);
            
            
            if(!is_null($user)){
                // If user credentials are valid, set cookie variables and redirect the user
                $user_role = $this->user_helper->getUserRole($user->get_id());
                if (is_null($user_role)){
                    header("Location: error_view.php");  // an error view for users with no role
                    exit();
                }
                
                $expires = time()+7*24*60*60; // one week
                setcookie('user_id', $user->get_id(),  $expires, '/');
                setcookie('user_role', $user_role, $expires, '/');
                setcookie('logged_in', 'true', $expires, '/');
                
                
                switch($user_role){
                    case 'admin':
                        header("Location: admin.php");  // to replace with Admin Main Page
                        exit();
                    case 'professor':
                        header("Location: professor.php");  // to replace with Professor Main Page
                        exit();
                    case 'student':
                        header("Location: student.php");  // to replace with Student Main Page
                        exit();
                    default:
                        echo "Unknown user role!";
                        break;
                }
            
            }
            else{ 
                    $this->viewWithError();
            }
            
        }

        $this->view();
    }




}

?>