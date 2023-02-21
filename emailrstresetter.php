<?php

include("connector.php");


                     $exiit = null;
$nulll = null;
if(empty($_POST["record_id"])){
    echo "<p>Error</p>";
    exit;
    
}else{
    $record_id = $_POST["record_id"];
}
if(empty($_POST["email"])){
    $exiit = "<p>Enter new email please</p>";
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemailerror;
    }
}
if(empty($_POST["email2"])){
    $exiit = "<p>Confirm new email please</p>";
}else{
    $email2 = filter_var($_POST["email2"], FILTER_SANITIZE_EMAIL);
    if($email2 != $email){
        $exiit = "<p>Submitted emails do not match. Please correct.</p>";
    }
}
if($exiit != $nulll){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>".$exiit."</div>";
        exit;
}
//check if submitted email can be found in users table;
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Debug 111r</div>";
        exit;
}
$coutn = mysqli_num_rows($result);
if($coutn > 0){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Email taken, try another one. Do you have more than one account? Do note that it is against our term of service to have multiple accounts. If you need help, contact support.</div>";
        exit;
}
//Email do not exist. Now let's get started

//fetch instance from the resetemail dB.
$sql = "SELECT * FROM resetemail WHERE id='$record_id' AND status='used'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to run verification query. Please try again later</div>";
        exit;
}
$coutn = mysqli_num_rows($result);
if($coutn != 1){

    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>FATAL ERROR: Please restart password reset process or contact support</div>";
        exit;
}else{
    //equal to 1. Proceed
    //run update to update newtime, newemail and status;
    $newtime = time() + 86400;
    $firstfetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $firstfetch["username"];
   
        $sql = "UPDATE resetemail SET status='turbo', newemail='$email', newtime='$newtime' WHERE id='$record_id' AND username='$username'";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to update instance record fgf</div>";
        exit;
        }else{
            //it ran
            //check affected rows
            $secondcheck = mysqli_affected_rows($link);
            if($secondcheck != 1){
                echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to update instance record bulaba</div>";
        exit;
            }else{
                //update successful
                // mail new email with final activation link and echo 3 for success.
                 //Mail the user.
     $message = "<h1>Puffers final email reset</h1><br>";
        $message .= "<p>Hi, ".$username.", confirm your request to update this email address as your Puffers email address;</p><br>";
    
        $message .= "<p>Proceed by clicking the button below;<br></p>";
        $message .= "<form action='".$webserverbaselink."emailrst2.php' method='post' >
        <input type='hidden' name='record_id' value='".$record_id."'>
        <input type='hidden' name='newtime' value='".$newtime."'>
        <input type='submit' value='Verify my new email address'></form>";
        //message footer
        $time = time();
        $daate = date('Y', $time);
        $message .= "<p style='color:red; width: 100%; background-color: black; text-align: center; margin: 0px 0px; padding: 15px 0px;'>Puffers Arena. Copyright &copy;  2022 - ".$daate." All rights reserved </p>";
        
        $messagebody = "<div style='text-align: center; border: 10px black; border-style: solid; border-radius: 100px '>".$message."</div>";
           $headerss = 'MIME-Version: 1.0' . "\r\n";
$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headerss .= "From: hashpro212@gmail.com" . "\r\n";

     //check if sent, if yeah, then echo that it's successful and they can proceed to login
    if(mail($email, "Verify new Puffers email address", $messagebody, $headerss)){
        echo "3";
    }else{
        echo "<div class='alert alert-danger'>ERROR 3333</div>";
    exit;
    }

            }
        }
        
        
    }
?>