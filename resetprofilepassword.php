
<?php
include('connector.php');
//Define errors
$wahallaaaaaaaaaaa ="<p>Invalid current password.</p>";
$missingoldpassword = "<p>Enter current password please</p>";
$error1 = "<p>You forgot to enter new password?</p>";
$error2 = "<p>Re-enter new password please</p>";
$invalidpassworderror = "<p>You have supplied an invalid new password. It has to be a minimum of 6 characters with at least one capital letter and one number.</p>";
$differentpassworderror = "<p>Supplied new passwords do not match.</p>";
$errors = null;
$failed = '<div class="alert alert-danger" style="font-weight: bold;">Password reset process failed. Contact support with error code: lsgjagjal;gkja;gja;aaa</div>';
//GET  OLD PASSWORD
if(empty($_POST["oldpassword"])){
    $errors .= $missingoldpassword;
}elseif(!strlen($_POST["oldpassword"])<6 and preg_match('/[A-Z]/', $_POST["oldpassword"]) and preg_match('/[0-9]/', $_POST["oldpassword"])){
        $old_password = filter_var($_POST["oldpassword"], FILTER_SANITIZE_STRING);
    }else{
         $errors .= $wahallaaaaaaaaaaa;
    }

//GET PASSWORD
if(empty($_POST["newpassword"])){
    $errors .= $error1;
}elseif(!strlen($_POST["newpassword"])<6 and preg_match('/[A-Z]/', $_POST["newpassword"]) and preg_match('/[0-9]/', $_POST["newpassword"])){
        $password = filter_var($_POST["newpassword"], FILTER_SANITIZE_STRING);
    }else{
         $errors .= $invalidpassworderror;
    }

//GET AND COFIRM SECOND PASSWORD
if(empty($_POST["newpassword2"])){
    $errors .= $error2;
}else{
    if($_POST["newpassword2"] != $_POST["newpassword"]){
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
    echo '<div class="alert alert-danger" style="font-weight: bold;">An error was ran into: fhakjfhkhjkfkfkhf</div>';
        exit;
}
    if(!empty($_POST["username"])){
        $username = $_POST["username"];
}else{
    echo '<div class="alert alert-danger" style="font-weight: bold;">An error was ran into: ajhgfrgeygugdshhjdfshf</div>';
        exit;
}
   
    //Hash and feed the details into the database and then return a message saying they should proceed to login to their account
    //Smartass.... it's called variable preparation for queries
    $old_password = mysqli_real_escape_string($link, $old_password);
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    /// Hash passwords
    $password = hash('sha256', $password);
     $old_password =  hash('sha256', $old_password);
//    compare old password with existing password, if same,run code. If not same, echo incorrect current password and exit
    $sql = "SELECT * FROM users WHERE username='$username' AND user_id='$user_id'";
        $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger" style="font-weight: bold;">Unable to run query to check if password supplied is same as currently supplied</div>';
        exit;
    }else{
        //make sure it's one
        $fhgghghghg = mysqli_num_rows($result);
        if($fhgghghghg == 1){
        $bnb = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($bnb['password'] == $old_password){
            $sql = "UPDATE users SET password='$password' WHERE username='$username' AND user_id='$user_id'";
        $result = mysqli_query($link, $sql);
            $finalcheck = mysqli_affected_rows($link);
            if($finalcheck == 1){
               echo "1";
            }else{
                echo '<div class="alert alert-danger" style="font-weight: bold;">An error was ran into. sfkjsjfsheiuwugwggwgyfgik</div>';
            exit;
            }
        }else{
            echo '<div class="alert alert-danger" style="font-weight: bold;">Incorrect current password.</div>';
            
        }       
    }
    }
}


?>