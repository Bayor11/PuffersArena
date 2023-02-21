<?php
//start a session
session_start();
//Connect to dB
include ("connector.php");
//Define possible errors
$missingusernameerror = "<p>Yo! Puff-in a Username</p>";
$Usernametakenerror = "<p>Comrade, that username has already been taken. Try another one.</p>";
$missingemailerror = "<p>Comrade, you haven't supplied an email address!</p>";
$invalidemailerror = "<p>Invalid email address.</p>";
$emailtakenerror = "<p>Email address taken. Having trouble Puffing in? Try reseting your password on Puff-in page</p>";
$missingpassworderror = "<p>No way! Enter your password abeg.</p>";
$invalidpassworderror = "<p>Yo!, that password is invalid. It has to be a minimum of 6 characters with at least one capital letter and one number.</p>";
$missingpassword2error = "<p>Confirm your password too nw!</p>";
$differentpassworderror = "<p>Those passwords don't match. Check your combination.</p>";
//Check and collect user inputs comming from AJAX here...
//Try defining error as a null variable first.
$errors = null;
//GET USERNAME
if(empty($_POST["username"])){
    $errors .= $missingusernameerror;
}else{
    //assign filtered values to variable names...
    $username= filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
//Code a way to check if username is taken bruvvv. Love you!



//GET EMAIL
if(empty($_POST["email"])){
    $errors .= $missingemailerror;
}else{
    //assign filtered values to variable names...
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemailerror;
    }
}
//GET PASSWORD
if(empty($_POST["password"])){
    $errors .= $missingpassworderror;
}elseif(!strlen($_POST["password"])<6 and preg_match('/[A-Z]/', $_POST["password"]) and preg_match('/[0-9]/', $_POST["password"])){
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    }else{
         $errors .= $invalidpassworderror;
    }

//GET AND COFIRM SECOND PASSWORD
if(empty($_POST["password2"])){
    $errors .= $missingpassword2error;
}else{
    if($_POST["password2"] != $_POST["password"]){
    $errors .= $differentpassworderror;
}
}

//>>>>>>>>>>>>>CHECK IF ANY ERROR EXISTS AND DISPLAY IT OR CONTINUE TO PROCESS THE COLLECTED DATAS IF NON EXIST
if($errors){
    $errormessage = '<div class="alert alert-danger" style="font-weight: bold;">' . $errors . '</div>';
    echo $errormessage;
}else{
    //Hash and feed the details into the database and then return a message saying they should proceed to login to their account
    //Smartass.... it's called variable preparation for queries
    $username = mysqli_real_escape_string($link, $username);
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    /// Hash password
//    $password = md5($password);

    $password = hash('sha256', $password);
    ///////////////////////////////////////////////
    //Verify that username doesn't exists...
    $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        //this query only returns false or an object to let us know if it is successful or not. If it's successful, this statement will be skipped.
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run username verification query.</div>';
        exit;
    }
   $resultss = mysqli_num_rows($result);
    //statement written below will only be true if the difference is greater than zero. Though the result can be zero in which case it couldn't find any match
    if($resultss){
        echo $Usernametakenerror;
        exit;
    }
    
    ///////////////////////////////////////////////////
        //Verify that email doesn't exist too
    $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        //this query only returns false or an object to let us know if it is successful or not. If it's successful, this statement will be skipped.
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run email verification query.</div>';
        exit;
    }
   $resultss = mysqli_num_rows($result);
    
    if($resultss){
        echo $emailtakenerror;
        exit;
    }
    /////////////////////////////
    // Create random numbers for activation
    $firstkey = bin2hex(openssl_random_pseudo_bytes(16));
    //Insert the stuffs
    $sql = "INSERT INTO users (`username`, `email`, `password`, `activation`) VALUES ('$username', '$email', '$password', '$firstkey')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run data insertion query.</div>';
        exit;
    }
        //mail activation link. Add url encoded link>>>>>>>>>>>>>>>>>
//    $headerss = 'content-type: text/html';
//    $message = " Hi $username, Click on this link to activate your account bruvv\n\n";
//    //Activation link button and stuffs goes down here...
//    //with activationkey and username supplied in the link as a GET parameter like this; http://localhost/puffersarena/activate.php?activationkey=37ef3b34a3fe1bdce057e03c736e8f02&username=kENKENfdfe
//    $message .= '';
//    mail($email, "Confirm your Registration bruv", $message, "From:". "hashpro212@gmail.com", $headerss);
  
     $message = "<h1>Puffers account activation</h1><br>";
        $message .= "<p>Hi, ".$username.", welcome to the amazing Puffers community. One last check before we let you in though. <br> Click on the button below to activate your account;</p><br>";
        $message .= "<form action='".$webserverbaselink."activate.php' method='get' >
        <input type='hidden' name='activationkey' value='".$firstkey."'>
        <input type='hidden' name='username' value='".$username."'>
        <input type='submit' value='Activate my account'></form>";
        
        
        $message .= "<p>If you didn't sign an account up with us, ignore this mail or, <strong>Contact support right away</srong> to have your email removed from our database. Thanks!</p>";
        //message footer
        $daate = date('Y');
        $message .= "<p style='color:red; width: 100%; background-color: black; text-align: center; margin: 0px 0px; padding: 15px 0px;'>Puffers Arena. Copyright &copy;  2022 - ".$daate." All rights reserved </p>";
        
        $messagebody = "<div style='text-align: center; border: 10px black; border-style: solid; border-radius: 100px '>".$message."</div>";
        $headerss = 'MIME-Version: 1.0' . "\r\n";
$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headerss .= "From: hashpro212@gmail.com" . "\r\n";

     //check if sent, if yeah, then echo that it's successful and they can proceed to login
    if(mail($email, "Confirm your Registration bruv", $messagebody, $headerss)){
        echo '<div class="alert alert-success" style="font-weight: bold;">Registration successful. Proceed to check your inbox to verify and activate your account. Let\'s get puffing!</div>';
        exit;
    }else{
        echo '<div class="alert alert-success" style="font-weight: bold;">Registration successful. But mail has not been sent to you</div>';
        exit;
    }
            
    
    }

?>