<?php
//start session
session_start();
//connect to db
include ('connector.php');
//Define possible errors
$missingusername = '<p><strong>Input your Puffer\'s username please</strong></p>';
$missingpassword = '<p><strong>Password field can\'t be empty</strong></p>';
$incorrect_login_details = '<p><strong>Wrong username and password combination</strong></p>';

//check if fields are not empty
$errors = null;
if(empty($_POST['username'])){
    $errors = $missingusername;   
}else{
    $usnm = $_POST['username'];
}
if(empty($_POST['password'])){
    $errors .= $missingpassword;   
}else{
    $pwrd = $_POST['password'];
}
//show errors if present
if($errors){
    echo "<div class='alert alert-danger'>$errors</div>";
    exit;
}

//prepare data for query; no validation needed, just sanitize them
$username = filter_var($usnm, FILTER_SANITIZE_STRING);
$username = mysqli_real_escape_string($link, $username);
$password = filter_var($pwrd, FILTER_SANITIZE_STRING);
$password = mysqli_real_escape_string($link, $password);
//hash password to match storage hashing
$password = hash('sha256', $password);
//Run query to check if combination exists. Try running a trial query to see if user hasnt verified their email address yet
//if not verified...
//igbo
//    echo $username;
//    echo '<br>';
//    echo $pwrd;
//    echo '<br>';
//    echo $password;
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND activation!='activated'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger'>Sorry, we are unable to sign you in right now. kindly contact support with this error code 22235</div>";
    exit;
}else{
    $counter = mysqli_num_rows($result);

    if($counter !== 1){
        //also check for if activated here. if yes, sign user in
                                    //if verified... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND activation='activated'";
                            $result = mysqli_query($link, $sql);
                            if(!$result){
                                echo "<div class='alert alert-danger'>Sorry, we are unable to sign you in right now. kindly contact support with this error code 22233</div>";
                                exit;
                            }
                            $savii = mysqli_num_rows($result);
                            if($savii !== 1){
                                 echo "<div class='alert alert-danger'>$incorrect_login_details</div>";
                                exit;
                            }else{
                                $storage1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                //set session variables >>>>>>>>
                                $_SESSION['username'] = $storage1['username'];
                                 $_SESSION['user_id'] = $storage1['user_id']; 
                                
                            }
                            if(empty($_POST['rememberme'])){
                                echo "success";
                            }else{
                                //write remember me code >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> SET COOKIE
                            //create 2 randomly generated variables
                                $var1 = rand(100,1000000000);
                                $var2 =  bin2hex(openssl_random_pseudo_bytes(20));
                            //create a function that takes these variables as parameters
                                function remme($a, $b){
                                    $c = $a . $b;
                                    return $c;

                                }
                            //Call the function by passing the 2 created variables as its parameters
                                $cookiemode = remme($var1, $var2);
                            //create cookies that stores these functions on device
                                setcookie(
                                    "puffersremembermecookie",
                                    $cookiemode,
                                    time() + 86400
                                
                                );
                                setcookie(
                                    "puffersremembermecookie2",
                                    $var1,
                                    time() + 86400
                                
                                );
                                //save to db >>>>>>>>>>>>>>>>>>>>>>>>>>
                                //prepare values
                                $username = $_SESSION['username'];
                                $user_id =  $_SESSION['user_id'];
                                $expiration = time() + 86400;
                                $value1 = $var1;
                                $value2 = $cookiemode;
                            //query 
                                $sql = "INSERT INTO rememberme (`username`, `user_id`, `expiration`, `find`, `find2`) VALUES ('$username', '$user_id', '$expiration', '$value1', '$value2')";
                                $result = mysqli_query($link, $sql);
                                if(!$result){
                                    echo "HEEEEROOOR";
                                }else{
                                        echo 'success';
                                    };
                                }
                            
                            
                            }else{
     echo "<div class='alert alert-danger'>Hi ".$username." You have not verified your email address yet. Check your email and use the activation link sent to you. Thanks!</div>";
    exit;
    }

    }
   



?>