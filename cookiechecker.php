<?php
//check if there is cookie
//    if there is;
if(empty($_SESSION['user_id']) && !empty($_COOKIE['puffersremembermecookie']) && !empty($_COOKIE['puffersremembermecookie2'])){
    //Get stored cookies
    $value2 = $_COOKIE['puffersremembermecookie'];
    $value1 = $_COOKIE['puffersremembermecookie2'];
    
//if one used another method of storage,
//    list($value2, $value1) = explode('delimiter', $_COOKIE['cookiename'])
    
//        run a query through rememberme table
    $sql = "SELECT * FROM rememberme WHERE find='$value1' AND find2='$value2'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        //for debugging only. Stay neutral otherwise
        echo "<div class='alert alert-danger'>Sorry, we are unable to sign you in right now. kindly contact support with this error code CKIE111</div>";
        exit;
    }else{
        
        $count = mysqli_num_rows($result);
        if($count == 1){
            //fetch user details variables
        $nett = mysqli_fetch_array($result, MYSQLI_ASSOC);


        
            //set new cookie up and redirect to loggedinindex page 
            //if cookie time hasnot elapsed, sin them in, otherwise do nothing
            if($nett['expiration'] >= time()){
                        $username = $nett['username'];
                        $user_id = $nett['user_id'];
                                                //session-variables....
                        $_SESSION['user_id'] = $user_id;
                         $_SESSION['username'] =  $username; 
            
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
                                   
                                        //redirect user to loggedinindex page  
                                    header('location:loggedinindex.php');
                                    };
                
            }

            
            
            
    
        
        }
        
    }

}
?>