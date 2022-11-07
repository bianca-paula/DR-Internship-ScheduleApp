<?php

$users = array(
    array('email' => 'lala@gmail.com',
        'password' => 'lala',
        'role' => 'admin'),
    array('email' => 'floaredesoare@gmail.com',
        'password' => 'floaredesoare',
        'role' => 'professor'),
    array('email' => 'polonic@gmail.com',
        'password' => 'polonic',
        'role' => 'student')
);


// To be adapted to use database
function verify_user($email, $password, $users){
    // Checks that the credentials are valid and returns the user if it can be found
    
    foreach($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password){
            return $user;
        }
    }
    return null;
}

function display_login_view($error_visibility){
    ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&family=Righteous&display=swap"
        rel="stylesheet" 
    />
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <title>ScheduleApp Login</title>
</head>

<body>
    
    <div id="login_card">

        <div class="logo">
            <img src="images/logo_books.png" id="logo_image" alt="Logo Image">
            <label>ScheduleApp</label>
        </div>
        
        <form method="post" action="login.php">
            <input type="email" class="credential_input" id="input_email" placeholder="E-mail" name="input_email">
            <input type="password" class="credential_input" id="input_password" placeholder="Password" name="input_password">
            <p style="visibility:<?php echo $error_visibility; ?>"> Credentials don't match! Try again.</p>
            <button type="submit" class="submit_button" name="login_button" value="Register">LOG IN</button>
        </form>
        
    </div>

</body>
</html>
    <?php } ?>


<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'
    && !empty($_POST['input_email'])
    && !empty($_POST['input_password'])) {
       
        $user = verify_user($_POST['input_email'], $_POST['input_password'], $users);
        if(!is_null($user)){
            // If user credentials are valid, set cookie variables and redirect the user
            $expires = time()+7*24*60*60;
            setcookie('role', $user['role'], $expires, '/');
            setcookie('logged_in', 'true', $expires, '/');
            
            switch($user['role']){
                case 'admin':
                    header("Location: admin.php");  // to replace with Admin Main Page
                    exit();
                    break;
                case 'professor':
                    header("Location: professor.php");  // to replace with Professor Main Page
                    exit();
                    break;
                case 'student':
                    header("Location: student.php");  // to replace with Student Main Page
                    exit();
                    break;
                default:
                    echo "Unknown user role!";
                    break;
            }
        
        }
        else{ 
                display_login_view("visible"); // visible - error visibility
          }
        
    }
    
    else {
        display_login_view("hidden"); // hidden - error visibility
    }
    
 ?>









