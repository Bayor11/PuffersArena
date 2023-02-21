
<?php
include('connector.php');
//Define errors
$me = 'me';
$error1 = "<p>Password can't be empty</p>";
$error2 = "<p>Re-enter your password please</p>";
$invalidpassworderror = "<p>Yo!, that password is invalid. It has to be a minimum of 6 characters with at least one capital letter and one number.</p>";
$differentpassworderror = "<p>Those passwords don't match. Check your combination.</p>";
$errors = null;
$failed = '<div class="alert alert-danger" style="font-weight: bold;">Password reset process failed. Contact support with error code: lsgjagjal;gkja;gja;aaa</div>';
//GET PASSWORD
if(empty($_POST["password"])){
    $errors .= $error1;
}elseif(!strlen($_POST["password"])<6 and preg_match('/[A-Z]/', $_POST["password"]) and preg_match('/[0-9]/', $_POST["password"])){
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    }else{
         $errors .= $invalidpassworderror;
    }

//GET AND COFIRM SECOND PASSWORD
if(empty($_POST["password2"])){
    $errors .= $error2;
}else{
    if($_POST["password2"] != $_POST["password"]){
    $errors .= $differentpassworderror;
}
}

//>>>>>>>>>>>>>CHECK IF ANY ERROR EXISTS AND DISPLAY IT OR CONTINUE TO PROCESS THE COLLECTED DATAS IF NON EXIST
if($errors){
    $errormessage = '<div class="alert alert-danger" style="font-weight: bold;">'.$errors.'</div>';
    echo $errormessage;
}else{
    //check if hidden datas were supplied too
    if(!empty($_POST["user_id"])){
        $user_id = $_POST["user_id"];
}else{
    echo $failed;
        
//        echo $me;
        exit;
}
    if(!empty($_POST["username"])){
        $username = $_POST["username"];

}else{
    echo $failed;
        exit;
}
    if(!empty($_POST["record_id"])){
        $record_id = $_POST["record_id"];
}else{
    echo $failed;
        exit;
}
    //Hash and feed the details into the database and then return a message saying they should proceed to login to their account
    //Smartass.... it's called variable preparation for queries
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    /// Hash password
    $password = hash('sha256', $password);
//    compare new password with existing password, if same, show error and set it to null then exit and let me check
    $sql = "SELECT * FROM users WHERE username='$username' AND user_id='$user_id'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to check if password supplied is same as forgotten one</div>';
        exit;
    }else{
        $bnb = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($bnb['password'] == $password){
            //null the password
            $password = null;
            $sql = "UPDATE users SET password='$password' WHERE username='$username' AND user_id='$user_id'";
        $result = mysqli_query($link, $sql);
            echo '<div class="alert alert-danger" style="font-weight: bold;">Provided password is same as forgotten one. But this has been erased. Re-enter a different new password now.</div>';
            exit;
        }
    }
    $sttatus = "used";
    //before insertion, check if the status of record_id is not used
     $sql = "SELECT * FROM forgotpassword WHERE id='$record_id' AND user_id='$user_id' AND status='$sttatus'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to check if instance has been used before</div>';
        exit;
    }else{
        $bnbb = mysqli_num_rows($result);
        if($bnbb == 1){
            
            echo '<div class="alert alert-danger" style="font-weight: bold;">Please continue to Puffin now that your password has been reset. Instance has reached expiration.</div>';
            exit;
        }
    }

    //Run insertion query
    $sql = "UPDATE users SET password='$password' WHERE username='$username' AND user_id='$user_id'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run Password update query.</div>';
        exit;
    }

   $jiii = mysqli_affected_rows($link);
     if($jiii == 1){
         //update forgotpassword table by setting status to used
                                  //Run insertion query
                            $sql = "UPDATE forgotpassword SET status='used' WHERE id='$record_id' AND user_id='$user_id'";
                                $result = mysqli_query($link, $sql);
                            if(!$result){
                                echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run status update query in fgpd table.</div>';
                                exit;
                            }else{
                                //confirm the update
                                $jaaa = mysqli_affected_rows($link);
                                if($jaaa == 1){
                                     echo "<div class='alert alert-success'>Password has been successfully resetted. Click here to </div>";
         echo "<div class='btn btn-lg btn-info'><a href='index.php'>Puff-in</a></div>";
                                }else{
                                    echo "<div class='alert alert-danger'>Unable to change status in fgtpd table</a></div>";
                                }
                                
                                
                                
                                
                                
                                
                            }
            
         }else{
         echo "<div class='alert alert-danger'>Sorry, we are unable to reset your password at this moment. Please contact support <a href='contactus.php' class='btn-info btn'>here</a></div>";
     }


}


?>