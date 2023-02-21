<?php
include('connector.php');
//for test, set array key

//define possible errors missing and invalid emails
$emailmissing = "<p>You haven't Puff your email address in yet</p>";
$invalidemail = "<p>Please enter a valid email address</p>";

//check if an email was submitted
if($_POST['email']){
    //if yes
    //get it and validate and sanitize
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
       //if errors exists, echo it
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         echo "<div class='alert alert-danger'>".$invalidemail."</div>";
    exit;
    }
 
}else{
    //if no, echo missing email error and exit
    echo "<div class='alert alert-danger'>".$emailmissing."</div>";
    exit;
}
//>>>>>valid datas supplied, let's check if data exists in users db
//Run query
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($link, $sql);
//check if it ran
if($result){
    //if it did, check if count is 1
    $count = mysqli_num_rows($result);
    if($count == 1){
        //if yes
    //fetch array and extract id and username
        $fetcher = mysqli_fetch_array($result, MYSQLI_ASSOC);
       $user_id = $fetcher['user_id'];
        $username = $fetcher['username'];
    }else{
        //data doesnt exist in records, echo error and exit
        echo "<div class='alert alert-danger'>We couldn't find the email address you provided (<strong>".$email."</strong>) in our records. Check it, correct and try again if you made a mistake, otherwise return to our <a href='index.php'><em>home page</em></a> and become a Puffer today</div>";
    exit;
    }
    

}else{
    //if no, echo error that it couldn't run and exit
    
    echo "<div class='alert alert-danger'>An error was encountered, contact support with error code 1234lfgkjgjg;aahgh</div>";
    exit;
}


//>>>>>>datas fetched, now let's start reset by inserting datas into the forgotpassword table
//Neccessary fields are: user_id, username, keycode, time and status
//generate keycode and store in a variable
$keycode = rand(1000000, 100000000);
//set variables for time and status
//validity is 15 minutes = 900secs
$currenttime = time() + 900;
$status = 'pending';
//Run the insertion query
$sql = "INSERT INTO forgotpassword (`user_id`, `username`, `keycode`, `time`, `status`) VALUES ('$user_id', '$username', '$keycode', '$currenttime', '$status')";
    $result = mysqli_query($link, $sql);
if(!$result){
    //if it didn't run, echo error and exit
    echo "<div class='alert alert-danger'>An error was encountered, contact support with error code 122452sdlfgkjgjg;aahgh</div>";
    exit;
}else{
    //if it did, check row count to know if its one
//   for debugging; var_dump($result);
    //cant check row count on insertions because it returns boolean stuffs, so, let's query the last insertion to see if it exists
    $sql = "SELECT * FROM forgotpassword WHERE keycode='$keycode' AND status='$status' AND user_id='$user_id'";
$result = mysqli_query($link, $sql);
//check if it ran
if($result){
    //if it did, check if count is 1
    $count = mysqli_num_rows($result);
// for debugging;   var_dump($count);
    if($count == 1){
        //fetch record id
        $jkfjg = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $record_id = $jkfjg['id'];
        //mail the provided email address the reset link
        //mail message
       
        $message = "<h1>Puffers password recovery</h1><br>";
        $message .= "<p>Hi, ".$username.", a request was recently made to reset your password. <br>If this request was made by you, Click on the button below to proceed. <br>Note that this is only valid for 15 minutes.</p><br>";
        $message .= "<form action='".$webserverbaselink."forgottenpasswordresetter.php' method='get' >
        <input type='hidden' name='record_id' value='".$record_id."'>
        <input type='hidden' name='keycode' value='".$keycode."'>
        <input style='color: black;' type='submit' value='Create new Password'></form>";
        
        
        $message .= "<p>If you didn't make this request, <strong>Contact support right away</srong></p>";
        //message footer
        $time = time();
        $daate = date('Y', $time);
        $message .= "<p style='color:red; width: 100%; background-color: black; text-align: center; margin: 0px 0px; padding: 15px 0px;'>Puffers Arena. Copyright &copy;  2022 - ".$daate." All rights reserved </p>";
        
        $messagebody = "<div style='text-align: center; border: 10px black; border-style: solid; border-radius: 100px '>".$message."</div>";
        $headerss = 'MIME-Version: 1.0' . "\r\n";
$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headerss .= "From: hashpro212@gmail.com" . "\r\n";

        //for now, leave open, normally, I ought to nest the code in an If statement before echoing success
        //link template http://localhost/puffersarena/forgottenpasswordresetter.php?record_id=&keycode=
        if(mail($email, "Puffers Arena password reset", $messagebody, $headerss)){
             echo "<div class='alert alert-success'>Instructions on how to reset your password has been sent to your provided email address. Check your mail box and follow the steps to continue. Let's get puffing!!!</div>";   
        }else{
            echo "<div class='alert alert-danger'>Process completed but you haven't been mailed. Please contact support.</div>";
        }
        
       
//then echo success that they should check their mail box

    }else{
         echo "<div class='alert alert-danger'>Password reset process failed, please contact support</div>";
    exit;
    }


}
}




?>