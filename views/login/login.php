
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../assets/style/login.css">
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
            <img src="../../assets/images/logo_books.png" id="logo_image" alt="Logo Image">
            <label>ScheduleApp</label>
        </div>
        
        <form method="get" action="scheduleapp.com/login.php">
            <input type="email" class="credential_input" id="input_email" placeholder="E-mail" name="input_email">
            <input type="password" class="credential_input" id="input_password" placeholder="Password" name="input_password">
            <p style="visibility:<?php echo $error_visibility; ?>"> Credentials don't match! Try again.</p>
            <button type="submit" class="submit_button" name="login_button" value="Register">LOG IN</button>
        </form>
        
    </div>

</body>
</html>




