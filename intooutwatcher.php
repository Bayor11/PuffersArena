<?php
//check if there is a session ongoing
//    if there is;
if(!empty($_SESSION['user_id']) && !empty($_SESSION['username'])){
    //Get session values
    $value1 = $_SESSION['user_id'];
    $value2 = $_SESSION['username'];
    //verify values
    $sql = "SELECT * FROM users WHERE user_id='$value1' AND username='$value2'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        //exit check
        exit;
    }else{
        
        $count = mysqli_num_rows($result);
        if($count == 1){
            //fetch user details variables
        $nett = mysqli_fetch_array($result, MYSQLI_ASSOC);
            //set new cookie up
                        $username = $nett['username'];
                        $user_id = $nett['user_id'];            
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
                                   exit;
                                }
                
        }
        
    }

}else{
      //redirect user to index page  
                                    header('location:index.php');
}
?>